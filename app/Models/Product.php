<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'price' => 'integer'
    ];

    protected $guarded = [];

    public function delivery()
    {
        return $this->hasMany(Delivery::class, 'size', 'size');
    }

    public function path()
    {
        return '/products/' . $this->id;
    }
}
