<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_name',
        'brand_photo',
        'brand_explanation'
    ];

    // category
    public function categories(){
        return $this->hasMany(Categories::class,'brand_id','id');
    }
    public function products(){
        return $this->hasMany(Products::class,'brand_id','id');
    }
}
