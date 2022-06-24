<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'reference',
        'discount',
        'price',
        'category_id',
        'status',
        'picture_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class)->withPivot('product_id', 'size_id');
    }

    public function picture()
    {
        return $this->belongsTo(Picture::class);
    }

    public static function getProductsWithDiscount()
    {
        return Product::where('discount', 'standard');
    }
}
