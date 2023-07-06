<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $categories = Categories::all();
        return response()->json([
            'status' => 'success',
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        /* $request->validate([
             'category_name' => 'required|string|max:255',
             'category_photo' => 'required|mimes:jpeg,png,jpg|size:3072',
             'category_explanation' => 'required|string|max:255',
             'brand_id' => 'required|number|max:255',
        ]);*/

        $category_photo_name = time().'.'.$request->category_photo->extension();
        $request->category_photo->move(public_path('uploads'), $category_photo_name);



        $category = Categories::create([
            'category_name' => $request->category_name,
            'brand_id' => $request->brand_id,
            'category_photo' => $category_photo_name,
            'category_explanation' => $request->category_explanation,
        ]);

        $updated = Categories::with('brands')->find($category->id);

        return response()->json([
            'status' => 'success',
            'message' => 'Category created successfully',
            'category' => $updated ,
        ]);
    }

    public function show($id)
    {
        $category = Categories::find($id);
        return response()->json([
            'status' => 'success',
            'category' => $category,
        ]);
    }

    public function update(Request $request, $id)
    {
        /*$request->validate([
            'category_name' => 'required|string|max:255',
            'category_photo' => 'mimes:jpeg,png,jpg|size:3072',
            'category_explanation' => 'required|string|max:255',
            'brand_id' => 'required|number|max:255',
        ]);*/


        if($request->hasFile('category_photo')){
            $category_photo_name = time().'.'.$request->category_photo->extension();
            $request->category_photo->move(public_path('uploads'), $category_photo_name);

            $category = Categories::find($id);
            $category->category_name = $request->category_name;
            $category->category_photo = $category_photo_name;
            $category->category_explanation = $request->category_explanation;
            $category->brand_id = $request->brand_id;
            $category->save();
        } else {
            $category = Categories::find($id);
            $category->category_name = $request->category_name;
            $category->category_explanation = $request->category_explanation;
            $category->brand_id = $request->brand_id;
            $category->save();
        }

        $updated = Categories::with('brands')->find($category->id);

        return response()->json([
            'status' => 'success',
            'message' => 'Category updated successfully',
            'category' => $updated,
        ]);
    }

    public function destroy($id)
    {
        $category = Categories::find($id);
        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Category deleted successfully',
            'category' => $category,
        ]);
    }
}
