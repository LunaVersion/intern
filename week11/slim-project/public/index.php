<?php

declare(strict_types=1);

use App\Application\Handlers\HttpErrorHandler;
use App\Application\Handlers\ShutdownHandler;
use App\Application\ResponseEmitter\ResponseEmitter;
use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface;

require __DIR__ . '/../vendor/autoload.php';

// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();

if (false) { // Should be set to true in production
	$containerBuilder->enableCompilation(__DIR__ . '/../var/cache');
}

// Set up settings
$settings = require __DIR__ . '/../app/settings.php';
$settings($containerBuilder);

// Set up dependencies
$dependencies = require __DIR__ . '/../app/dependencies.php';
$dependencies($containerBuilder);

// Set up repositories
$repositories = require __DIR__ . '/../app/repositories.php';
$repositories($containerBuilder);

// Build PHP-DI Container instance
$container = $containerBuilder->build();

// Instantiate the app
AppFactory::setContainer($container);
$app = AppFactory::create();
$callableResolver = $app->getCallableResolver();
$db = $container->get('db');
// Register middleware
$middleware = require __DIR__ . '/../app/middleware.php';
$middleware($app);

// Register routes
$routes = require __DIR__ . '/../app/routes.php';
$routes($app);

//----------------------------------------
$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
});

// cấu hình cho react
// Serve static files (CSS, JS, images) from React build
$app->add(function (Request $request, RequestHandlerInterface $handler): Response {
    $path = $request->getUri()->getPath();
    
    // Nếu URL bắt đầu bằng /static hoặc /manifest.json, phục vụ file
    if (preg_match('#^/(static/.*|manifest\.json)$#', $path)) {
        $filePath = __DIR__ . '/../frontend/react-frontend/build' . $path;

        if (is_file($filePath)) {
            $mimeType = mime_content_type($filePath);
            $stream = new Stream(fopen($filePath, 'rb'));

            $response = new Response();
            return $response->withBody($stream)
                            ->withHeader('Content-Type', $mimeType);
        }
    }

    // Nếu không thì để các route khác xử lý
    return $handler->handle($request);
});

// Serve React index.html for all other non-API routes
$app->get('/', function (Request $request, Response $response) {
    $html = file_get_contents(__DIR__ . '/../frontend/react-frontend/build/index.html');
    $response->getBody()->write($html);
    return $response;
});

// Serve React index.html for root '/'
$app->get('/{routes:.+}', function (Request $request, Response $response) {
    $html = file_get_contents(__DIR__ . '/../frontend/react-frontend/build/index.html');
    $response->getBody()->write($html);
    return $response;
});
//---------------------------------------

/** @var SettingsInterface $settings */
$settings = $container->get(SettingsInterface::class);

$displayErrorDetails = $settings->get('displayErrorDetails');
$logError = $settings->get('logError');
$logErrorDetails = $settings->get('logErrorDetails');

// Create Request object from globals
$serverRequestCreator = ServerRequestCreatorFactory::create();
$request = $serverRequestCreator->createServerRequestFromGlobals();

// Create Error Handler
$responseFactory = $app->getResponseFactory();
$errorHandler = new HttpErrorHandler($callableResolver, $responseFactory);

// Create Shutdown Handler
$shutdownHandler = new ShutdownHandler($request, $errorHandler, $displayErrorDetails);
register_shutdown_function($shutdownHandler);

// Add Routing Middleware
$app->addRoutingMiddleware();

// Add Body Parsing Middleware
$app->addBodyParsingMiddleware();

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware($displayErrorDetails, $logError, $logErrorDetails);
$errorMiddleware->setDefaultErrorHandler($errorHandler);

// Cho phép tất cả route OPTIONS để React gửi preflight request
$app->options('/{routes:.+}', function (Request $request, Response $response): Response {
    return $response;
});

// Run App & Emit Response
$response = $app->handle($request);
$responseEmitter = new ResponseEmitter();
$responseEmitter->emit($response);


