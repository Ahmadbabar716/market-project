<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'unit',
        'price',
        'image',
        'featured',
        'sort_order',
        'active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'featured' => 'boolean',
        'active' => 'boolean',
    ];

    public function scopeFeatured($query)
    {
        return $query->where('featured', true)->where('active', true)->orderBy('sort_order');
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
