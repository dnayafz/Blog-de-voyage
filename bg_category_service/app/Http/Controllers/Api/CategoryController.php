<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Str;

class CategoryController extends Controller{
    
    public function getAllCategories(){
        try {
            $categories = Category::all();
            return response()->json([
                'status' => true,
                'categories' => $categories
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getSingleCategory($id){
        try {
            $category = Category::where('id', $id)->first();
            return response()->json([
                'status' => true,
                'category' => $category
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function createCategory(Request $request){
        try {
            $category = Category::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title)
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Category Created Successfully',
                'category' => $category
            ], 200);

        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function updateCategory(Request $request, $id){
        try {
            $category = Category::where('id', $id)->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Category Updated Successfully',
                'category' => $category
            ], 200);

        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    
    public function deleteSingleCategory($id){
        try {
            $category = Category::where('id', $id)->first();
            $category->delete();
            return response()->json([
                'status' => true,
                'message' => 'Category deleted Successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
