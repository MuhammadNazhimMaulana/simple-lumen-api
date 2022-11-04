<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    // Nama Tabel
    protected $table = 'foods';

    // primary key
    protected $primaryKey = 'id';

    // Fillable
    protected $fillable = ['name', 'description', 'category_id', 'gambar', 'created_at', 'updated_at'];

    // Relationship
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}