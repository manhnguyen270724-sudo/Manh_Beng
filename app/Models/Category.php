<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Cho phép insert dữ liệu
    protected $fillable = ['name'];

    // Quan hệ: 1 category có nhiều product
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}