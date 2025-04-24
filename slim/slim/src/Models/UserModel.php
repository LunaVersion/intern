<?php

namespace App\Models;

class UserModel
{
    public static function findUser($email, $password) {
        //  dữ liệu mẫu
        $fakeUser = [
            'email' => 'Luna@gmail.com',
            'password' => '300303',
            'name' => 'Le Thi Huong'
        ];
        // kiểm tra ttin đăng nhập
        if ($email === $fakeUser['email'] && $password === $fakeUser['password']) {
            return ['email' => $fakeUser['email'], 'name' => $fakeUser['name']];
        }

        return null;
    }
}