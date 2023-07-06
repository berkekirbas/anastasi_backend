<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $products = Products::all();
        return response()->json([
            'status' => 'success',
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        /* $request->validate([
             'product_name' => 'required|string|max:255',
             'product_photo' => 'required|mimes:jpeg,png,jpg|size:3072',
             'product_explanation' => 'required|string|max:255',
              'product_price' => 'required|number|max:255',
             'brand_id' => 'required|number|max:255',
             'category_id' => 'required|number|max:255',
        ]);*/

        /*$product_photo_name = time().'.'.$request->product_photo->extension();
        $request->product_photo->move(public_path('uploads'), $product_photo_name);*/

        $data = [];
        $images = $request->file('product_photo');
        foreach ($images as $image) {
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('uploads'), $imageName);

            array_push($data, $imageName);
        }

        $product = Products::create([
            'product_name' => $request->product_name,
            'product_photo' => $data[0],
            'product_explanation' => $request->product_explanation,
            'product_price' => $request->product_price,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'photos' => json_encode($data)
        ]);

        $updated = Products::with('brands', 'category')->find($product->id);

        return response()->json([
            'status' => 'success',
            'message' => 'Product created successfully',
            'product' => $updated,
        ]);
    }

    public function show($id)
    {
        $product = Products::find($id);
        return response()->json([
            'status' => 'success',
            'product' => $product,
        ]);
    }

    public function update(Request $request, $id)
    {
        /* $request->validate([
             'product_name' => 'required|string|max:255',
             'product_photo' => 'required|mimes:jpeg,png,jpg|size:3072',
             'product_explanation' => 'required|string|max:255',
              'product_price' => 'required|number|max:255',
             'brand_id' => 'required|number|max:255',
             'category_id' => 'required|number|max:255',
        ]);*/


        if($request->product_photo){
            $product_photo_name = time().'.'.$request->product_photo->extension();
            $request->product_photo->move(public_path('uploads'), $product_photo_name);

            $product = Products::find($id);
            $product->product_name = $request->product_name;
            $product->product_photo = $product_photo_name;
            $product->product_explanation = $request->product_explanation;
            $product->product_price = $request->product_price;
            $product->brand_id = $request->brand_id;
            $product->category_id = $request->category_id;
            $product->save();
        } else {
            $product = Products::find($id);
            $product->product_name = $request->product_name;
            $product->product_explanation = $request->product_explanation;
            $product->product_price = $request->product_price;
            $product->brand_id = $request->brand_id;
            $product->category_id = $request->category_id;
            $product->save();
        }

        $updated = Products::with('brands', 'category')->find($product->id);

        return response()->json([
            'status' => 'success',
            'message' => 'Product updated successfully',
            'product' => $updated,
        ]);
    }

    public function destroy($id)
    {
        $product = Products::find($id);
        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted successfully',
            'product' => $product,
        ]);
    }
}
