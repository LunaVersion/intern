<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Controllers\AuthController;
use App\Controllers\UserController;

// khai báo các route và ánh xạ đến action
return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    // Đường dẫn API cho người dùng
    $app->group('/api/users', function (Group $group) {
        // Lấy danh sách người dùng
        $group->get('', [UserController::class, 'index']);
        
        // Lấy thông tin người dùng theo ID
        $group->get('/{id}', [UserController::class, 'show']);
        
        // Thêm người dùng mới
        $group->post('', [UserController::class, 'store']);
        
        // Cập nhật thông tin người dùng
        $group->put('/{id}', [UserController::class, 'update']);
        
        // Xóa người dùng theo ID
        $group->delete('/{id}', [UserController::class, 'destroy']);
    });

    $app->post('/api/login', [AuthController::class, 'login']);

};
