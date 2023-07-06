<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use Illuminate\Http\Request;
use App\Models\User;

class PublicController extends Controller
{
    public function getBrands(){
        $brands = Brands::all();
        return response()->json([
            'status' => 'success',
            'brands' => $brands,
        ]);
    }

    public function _public_getBrandsWithAllProductsAndAllCategories($id)
    {
        $data = Brands::with('categories.products')->findMany($id);
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function getPhoneNumberForOrder(){
        $data = User::find(1)->phone;
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
