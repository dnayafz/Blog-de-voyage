<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller{
    
    public function getAllPosts(){
        try {
            $posts = Post::all();
            return response()->json([
                'status' => true,
                'posts' => $posts
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getSinglePost($id){
        try {
            $post = Post::where('id', $id)->first();
            return response()->json([
                'status' => true,
                'post' => $post
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function createPost(Request $request){
        try {
            $post = Post::create([
                'title' => $request->title,
                'body' => $request->body,
                'id_user' => $request->id_user,
                'id_category' => $request->id_category,
                'status' => $request->status
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Post Created Successfully',
                'post' => $post
            ], 200);

        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function updatePost(Request $request, $id){
        try {
            $post = Post::where('id', $id)->update([
                'title' => $request->title,
                'body' => $request->body,
                'id_category' => $request->id_category,
                'status' => $request->status
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Post Updated Successfully',
                'post' => $post
            ], 200);

        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    
    public function deleteSinglePost($id){
        try {
            $post = Post::where('id', $id)->first();
            $post->delete();
            return response()->json([
                'status' => true,
                'message' => 'Post deleted Successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getUserPosts($id){
        try {
            $posts = Post::where('id_user', $id)->get();
            return response()->json([
                'status' => true,
                'posts' => $posts
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getCategoryPosts($id){
        try {
            $posts = Post::where('id_category', $id)->get();
            return response()->json([
                'status' => true,
                'posts' => $posts
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
