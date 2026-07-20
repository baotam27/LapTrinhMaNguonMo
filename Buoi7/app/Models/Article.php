<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // Cấu hình để cho phép gán dữ liệu nhanh
    protected $fillable = ['id', 'title', 'body'];
}