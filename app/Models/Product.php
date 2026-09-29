<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'image',
        'price',
        'short_description',
        'description',
        'badge',
        'featured',
        'old_price',
        'stock',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function specs()
    {
        return $this->hasMany(ProductSpec::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}