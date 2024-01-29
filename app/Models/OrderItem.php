<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'lproduct_id',
        'price',
        'quantity'
        

    ];
    public function order(){
        return $this->belongTo(Oder::class,'order_id');
    }
    public function product(){
        return $this->belongTo(Product::class,'product_id');
    }
}
