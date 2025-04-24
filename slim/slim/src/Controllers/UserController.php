<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\UsersModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController
{
    // Lấy danh sách người dùng
    public function index(Request $request, Response $response): Response
    {
        $users = UsersModel::all(); // Lấy tất cả người dùng từ DB
        // return $response->withJson($users);
        $payload = json_encode($users);

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    // Lấy thông tin người dùng theo ID
    public function show(Request $request, Response $response, array $args): Response
    {
        $user = UsersModel::find($args['id']);
        
        if ($user) {
            $payload = json_encode($user);
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');
        }
        
        $payload = json_encode(['error' => 'User not found']);
        $response->getBody()->write($payload);
        return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
    }

    // Tạo người dùng mới
    public function store(Request $request, Response $response): Response
    {
        $data = json_decode($request->getBody()->getContents(), true);

        $user = new UsersModel();
        $user->name = $data['name'];
        $user->email = $data['email'];
        
        if ($user->save()) {
            $payload = json_encode($user);
            $response->getBody()->write($payload);
            return $response->withStatus(201)->withHeader('Content-Type', 'application/json');
        }

        $payload = json_encode(['error' => 'User could not be created']);
        $response->getBody()->write($payload);
        return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
    }

    // Cập nhật thông tin người dùng
    public function update(Request $request, Response $response, array $args): Response
    {
        $user = UsersModel::find($args['id']);

        if ($user) {
            $data = $request->getParsedBody(); // Đọc chuẩn JSON body, put không tự động parse json body như post
            
            $user->name = $data['name'] ?? $user->name;
            $user->email = $data['email'] ?? $user->email;

            if ($user->save()) {
                $payload = json_encode($user);
                $response->getBody()->write($payload);
                return $response->withHeader('Content-Type', 'application/json');
            }

            $payload = json_encode(['error' => 'Failed to update user']);
            $response->getBody()->write($payload);
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $payload = json_encode(['error' => 'User not found']);
        $response->getBody()->write($payload);
        return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
    }


    // Xóa người dùng
    public function destroy(Request $request, Response $response, array $args): Response
    {
        $user = UsersModel::find($args['id']);
        
        if ($user) {
            $user->delete();
            $payload = json_encode(['message' => 'User deleted successfully']);
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');
        }
        
        $payload = json_encode(['error' => 'User not found']);
        $response->getBody()->write($payload);
        return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
    }
}
