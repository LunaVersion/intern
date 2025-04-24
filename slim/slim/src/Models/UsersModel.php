<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    protected $table = 'users'; 
    // bắt buộc vì eloquent sẽ tự động thêm trường created_at và updated_at vào bảng
    public $timestamps = false; 
    protected $fillable = ['name', 'email',]; // Các trường có thể gán giá trị hàng loạt
}
