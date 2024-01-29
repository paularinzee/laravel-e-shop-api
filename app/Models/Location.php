<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table= 'locations';
    protected $fillable = [
        'area',
        'user_id',
        'street',
        'building'
    ];
    public function user(){
        return $this->belongTo(User::class,'user_id');
    }
    // public function service(){
    //     return $this->belongTo(Service::class);
    // }

}
