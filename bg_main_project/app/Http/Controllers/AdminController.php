<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Str;

class AdminController extends Controller{
    
    public function AdminDashboard(){
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.session('access_token')
        ])->post(env('AUTH_API_URL').'auth/check');
        if (!empty($response['message']) && $response['message'] == 'Unauthenticated') {
            return view('Admin.login');
        }else{
            if (!empty($response['status']) && $response['status'] == true) {
                return redirect()->route('getPosts');
            }else{
                return view('Admin.login');
            }
        }
    }

    public function getCategories(){
        $categories = Http::get(env('CATEGORY_API_URL').'categories')['categories'];
        return view('Admin.Categories.index', compact('categories'));
    }

    public function addCategory(){
        return view('Admin.Categories.create');
    }

    public function storeCategory(Request $request){
        $response = Http::post(env('CATEGORY_API_URL').'category/create', [
            'title' => $request->title,
        ]);
        return redirect()->route('getCategories');
    }

    public function editCategory($id){
        $category = Http::get(env('CATEGORY_API_URL').'category/'.$id)['category'];
        return view('Admin.Categories.edit', compact('category'));
    }

    public function updateCategory(Request $request, $id){
        Http::post(env('CATEGORY_API_URL').'category/update/'.$id, [
            'title' => $request->title,
        ]);
        return redirect()->route('getCategories');
    }

    public function deleteCategory($id){
        $response = Http::delete(env('CATEGORY_API_URL').'category/'.$id);
        return redirect()->route('getCategories');
    }

    public function getPosts(){
        $posts = Http::get(env('BLOG_API_URL').'posts')['posts'];
        $categories = Http::get(env('CATEGORY_API_URL').'categories')['categories'];
        foreach ($posts as $key => $post) {
            $posts[$key]['category'] =  collect($categories)->where('id', $post['id_category'])->first()['title'];
            $posts[$key]['image'] = Str::replace('api', 'storage', env('MEDIA_API_URL')).(Http::get(env('MEDIA_API_URL').'media/'.$post['id'])['media']['image'] ?? '');
            unset($posts[$key]['id_user']);
            unset($posts[$key]['updated_at']);
        }
        return view('Admin.Posts.index', compact('posts'));
    }

    public function addPost(){
        $categories = Http::get(env('CATEGORY_API_URL').'categories')['categories'];
        return view('Admin.Posts.create', compact('categories'));
    }

    public function viewPost($id){
        $post = Http::get(env('BLOG_API_URL').'post/'.$id)['post'];
        $postImg = Str::replace('api', 'storage', env('MEDIA_API_URL')).(Http::get(env('MEDIA_API_URL').'media/'.$post['id'])['media']['image'] ?? '');
        return view('Admin.Posts.view', compact('post', 'postImg'));
    }

    public function storePost(Request $request){
        $response = Http::post(env('BLOG_API_URL').'post/create', [
            'title' => $request->title,
            'body' => $request->body,
            'id_user' => session('userId'),
            'id_category' => $request->category,
            'status' => $request->status,
        ]);
        $img = fopen($request->file('image'), 'r');
        $newresponse = Http::attach(
            'attachment', 
            $img, 
            $request->image->getClientOriginalName()
        )->post(env('MEDIA_API_URL').'media/create', [
            'image_name' => $request->image->getClientOriginalName(),
            'id_post' => $response['post']['id']
        ]);
        return redirect()->route('getPosts');
    }

    public function editPost($id){
        $categories = Http::get(env('CATEGORY_API_URL').'categories')['categories'];
        $post = Http::get(env('BLOG_API_URL').'post/'.$id)['post'];
        return view('Admin.Posts.edit', compact('categories', 'post'));
    }

    public function updatePost(Request $request, $id){
        $response = Http::post(env('BLOG_API_URL').'post/update/'.$id, [
            'title' => $request->title,
            'body' => $request->body,
            'id_category' => $request->category,
            'status' => $request->status,
        ]);
        if (!empty($request->file('image'))) {
            $img = fopen($request->file('image'), 'r');
            $newresponse = Http::attach(
                'attachment', 
                $img, 
                $request->image->getClientOriginalName()
            )->post(env('MEDIA_API_URL').'media/update/'.$id, [
                'image_name' => $request->image->getClientOriginalName(),
                'id_post' => $id
            ]);
        }
        return redirect()->route('getPosts');
    }

    public function deletePost($id){
        $response = Http::delete(env('BLOG_API_URL').'post/'.$id);
        return redirect()->route('getPosts');
    }
}
