<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Controllers\UserController;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    // $app->group('/api/users', function (Group $group) {
    //     $group->get('', ListUsersAction::class);
    //     $group->get('/{id}', ViewUserAction::class);
    // });
    $app->get('/api/users', [UserController::class, 'index']);
    $app->post('/api/users', [UserController::class, 'createUser']);
    $app->get('/api/users/{id}', [UserController::class, 'getUserByID']);
    $app->put('/api/users/{id}', [UserController::class, 'updateUser']);
    $app->delete('/api/users/{id}', [UserController::class, 'deleteUser']);
        
};
