<?php

namespace App\Controllers;

use App\Models\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController
{
    // Hàm lấy tất cả dữ liệu người dùng
    public function index(Request $request, Response $response, $args)
    {
        // Lấy tất cả người dùng từ bảng `users`
        $users = User::all();

        // Trả về dữ liệu dưới dạng JSON
        $payload = json_encode($users);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }   
    // Hàm lấy người dùng theo ID
    public function getUserByID(Request $request, Response $response, array $args): Response
    {
        $user = User::find($args['id']);
        
        if ($user) {
            $payload = json_encode($user);
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');
        }
        
        $payload = json_encode(['error' => 'User not found']);
        $response->getBody()->write($payload);
        return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
    }

    public function createUser(Request $request, Response $response, $args)
    {
        // Lấy dữ liệu từ request body
        $data = json_decode($request->getBody()->getContents(), true);

        // Kiểm tra xem tất cả các trường cần thiết đã được gửi hay chưa
        // if (empty($data['name']) || empty($data['age']) || empty($data['gender']) || empty($data['dob']) || empty($data['address'])) {
        //     return $response->withStatus(400)->write('Missing required fields');
        // }

        // Tạo một người dùng mới
        $user = User::create([
            'name' => $data['name'],
            'age' => $data['age'],
            'gender' => $data['gender'],
            'dob' => $data['dob'],
            'address' => $data['address'],
        ]);

        //Trả về người dùng đã được tạo với mã trạng thái 201 (Created)
            $payload = json_encode(['error' => 'Missing required fields']);
            $response->getBody()->write($payload);
            return $response->withStatus(201)->withHeader('Content-Type', 'application/json');
    }
public function deleteUser(Request $request, Response $response, $args)
    {
        // Lấy người dùng theo ID
        $user = User::find($args['id']);
        
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
public function updateUser(Request $request, Response $response, $args)
    {
        $user = User::find($args['id']);

        if ($user) {
            $data = $request->getParsedBody(); // Đọc chuẩn JSON body, put không tự động parse json body như post
            
            $user->name = $data['name'] ?? $user->name;
            $user->age = $data['age'] ?? $user->age;
            $user->gender = $data['gender'] ??  $user->gender;
            $user->dob = $data['dob'] ?? $user->dob;
            $user->address = $data['address'] ?? $user->address;

            if ($user->save()) {
                $payload = json_encode($user);
                $response->getBody()->write($payload);
                return $response->withHeader('Content-Type', 'application/json');
            }

            $payload = json_encode(['error' => 'Failed to update user']);
            $response->getBody()->write($payload);
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');

        }
        if (!isset($data['name'], $data['age'], $data['gender'], $data['dob'], $data['address'])) {
            $payload = json_encode(['error' => 'Missing required fields']);
            $response->getBody()->write($payload);
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }
    }
}
