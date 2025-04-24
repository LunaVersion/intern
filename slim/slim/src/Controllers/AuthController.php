<?php
// src/Controllers/AuthController.php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Models\UserModel;

class AuthController {
    public function login(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
        // lấy dữ liệu từ request
        $data = $request->getParsedBody();
        //tìm user 
        $user = UserModel::findUser($data['email'], $data['password']);

        // kiểm tra thông tin đăng nhập
        if ($user) {
            $response->getBody()->write(json_encode([
                'status' => 'success',
                'user' => $user
            ]));
        } else {
            $response->getBody()->write(json_encode([
                'status' => 'error',
                'message' => 'Sai email hoặc mật khẩu'
            ]));
        }

        return $response->withHeader('Content-Type', 'application/json');
    }
}
?>