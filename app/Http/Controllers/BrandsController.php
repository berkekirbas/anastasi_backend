<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Brands;

class BrandsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $brands = Brands::all();
        return response()->json([
            'status' => 'success',
            'brands' => $brands,
        ]);
    }

    public function store(Request $request)
    {
       /* $request->validate([
            'brand_name' => 'required|string|max:255',
            'brand_photo' => 'required|mimes:jpeg,png,jpg|size:3072',
            'brand_explanation' => 'required|string|max:255',
        ]);*/



        $brand_photo_name = time().'.'.$request->brand_photo->extension();
        $request->brand_photo->move(public_path('uploads'), $brand_photo_name);



        $brand = Brands::create([
            'brand_name' => $request->brand_name,
            'brand_photo' => $brand_photo_name,
            'brand_explanation' => $request->brand_explanation,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Brand created successfully',
            'brand' => $brand,
        ]);
    }

    public function show($id)
    {
        $brand = Brands::find($id);
        return response()->json([
            'status' => 'success',
            'brand' => $brand,
        ]);
    }

    public function update(Request $request, $id)
    {
        /*$request->validate([
            'brand_name' => 'required|string|max:255',
            'brand_photo' => 'mimes:jpeg,png,jpg|size:3072',
            'brand_explanation' => 'required|string|max:255',
        ]);*/


        if($request->brand_photo){
            $brand_photo_name = time().'.'.$request->brand_photo->extension();
            $request->brand_photo->move(public_path('uploads'), $brand_photo_name);

            $brand = Brands::find($id);
            $brand->brand_name = $request->brand_name;
            $brand->brand_photo = $brand_photo_name;
            $brand->brand_explanation = $request->brand_explanation;
            $brand->save();
        }else {
            $brand = Brands::find($id);
            $brand->brand_name = $request->brand_name;
            $brand->brand_explanation = $request->brand_explanation;
            $brand->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Brand updated successfully',
            'brand' => $brand,
        ]);
    }

    public function destroy($id)
    {
        $brand = Brands::find($id);
        $brand->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Brand deleted successfully',
            'brand' => $brand,
        ]);
    }
}
