<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'category_photo',
        'category_explanation',
        'brand_id'
    ];


    public function brands(){
        return $this->belongsTo(Brands::class,'brand_id','id');
    }

    public function products(){
        return $this->hasMany(Products::class, 'category_id', 'id');
    }
}
