<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table= 'products';
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'is_trendy',
        'is_available',
        'price',
        'amount',
        'discount',
        'image'

    ];
    public function category(){
        return $this->belongTo(Category::class,'category_id');
    }
    public function brand(){
        return $this->belongTo(Brand::class,'brand_id');
    }
}
