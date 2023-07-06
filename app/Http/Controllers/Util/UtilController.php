<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class UtilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /* marka ile birlikte kategorilerini çekme */
    public function getBrandWithCategory($id)
    {
        $data = Brands::with('categories')->find($id);
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function getBrandWithProduct($id)
    {
        $data = Brands::with('products')->find($id);
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function getCategoriesWithBrand(){
        $data = Categories::with('brands')->get();
        return response()->json([
            'status' => 'success',
            'categories' => $data
        ]);
    }

    public function getProductsWithCategoryAndBrand(){
        $data = Products::with('brands','category')->get();
        return response()->json([
            'status' => 'success',
            'products' => $data
        ]);
    }

    public function getCategoryWithBrand($id)
    {
        $data = Categories::with('brands')->find($id);
        return response()->json([
            'status' => 'success',
            'brands' => $data,
        ]);
    }

    public function getCategoryWithProduct($id)
    {
        $data = Categories::with('products')->find($id);
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function getProductWithCategory($id)
    {
        $data = Products::with('category')->find($id);
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function getProductWithBrand($id)
    {
        $data = Products::with('brands')->find($id);
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function getProductWithCategoryAndBrand($id)
    {
        $data = Products::with('brands', 'category')->find($id);
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function getBrandsWithAllProductsAndAllCategories($id)
    {
        $data = Brands::with('products.category')->findMany($id);
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
