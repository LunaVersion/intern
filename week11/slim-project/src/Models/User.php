<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class User extends Model
{
    // Đặt tên bảng trong cơ sở dữ liệu (Eloquent tự động tìm bảng 'users')
    protected $table = 'users';
    public $timestamps = false; 
    // Các thuộc tính có thể được gán hàng loạt
    protected $fillable = ['name', 'age', 'gender', 'dob', 'address'];
}