<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_photo',
        'product_explanation',
        'product_price',
        'category_id',
        'brand_id',
        'photos'
    ];

    public function brands(){
        return $this->belongsTo(Brands::class,'brand_id','id');
    }

    public function category(){
        return $this->belongsTo(Categories::class,'category_id','id');
    }
}
