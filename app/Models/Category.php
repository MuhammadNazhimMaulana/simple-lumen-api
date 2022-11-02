<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Nama Tabel
    protected $table = 'categories';

    // primary key
    protected $primaryKey = 'id';

    // Fillable
    protected $fillable = ['name', 'slug', 'created_at', 'updated_at'];

    // Inverse
    public function food()
    {
        return $this->hasMany(Food::class, 'category_id');
    }
}