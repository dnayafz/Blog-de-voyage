<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Str;

class PageController extends Controller{

    public function userLogin(Request $request){
        $response = Http::post(env('AUTH_API_URL').'auth/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);
        if ($response['status'] == true) {
            session(['access_token' => $response['token'], 'userId' => $response['userId']]);
            return redirect()->route('getPosts');
        }else {
            return view('Admin.login');
        }
    }

    public function userLogout(){
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.session('access_token')
        ])->post(env('AUTH_API_URL').'auth/logout');
        if ($response['status'] == true) {
            session()->forget('access_token');
            session()->forget('userId');
            return redirect()->route('guestHomePage');
        }
    }

    public function guestHomePage(){
        $posts = Http::get(env('BLOG_API_URL').'posts')['posts'];
        $writers = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.session('access_token')
        ])->get(env('AUTH_API_URL').'writers')['users'];
        $categories = Http::get(env('CATEGORY_API_URL').'categories')['categories'];
        foreach ($posts as $key => $post) {
            if ($post['status']) {
                $posts[$key]['author_name'] =  collect($writers)->where('id', $post['id_user'])->first()['name'];
                $posts[$key]['image'] = Str::replace('api', 'storage', env('MEDIA_API_URL')).(Http::get(env('MEDIA_API_URL').'media/'.$post['id'])['media']['image'] ?? '');
                unset($posts[$key]['id_user']);
                unset($posts[$key]['updated_at']);
            }else{
                unset($posts[$key]);
            }
        }
        return view('User.index', compact('posts', 'categories'));
    }

    public function getPost($id){
        $post = Http::get(env('BLOG_API_URL').'post/'.$id)['post'];
        $postImg = Str::replace('api', 'storage', env('MEDIA_API_URL')).(Http::get(env('MEDIA_API_URL').'media/'.$post['id'])['media']['image'] ?? '');
        $categories = Http::get(env('CATEGORY_API_URL').'categories')['categories'];
        return view('User.post', compact('post', 'postImg', 'categories'));
    }

    public function getCategoryPosts($id){
        $posts = Http::get(env('BLOG_API_URL').'posts/category/'.$id)['posts'];
        $writers = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.session('access_token')
        ])->get(env('AUTH_API_URL').'writers')['users'];
        $categories = Http::get(env('CATEGORY_API_URL').'categories')['categories'];
        foreach ($posts as $key => $post) {
            $posts[$key]['author_name'] =  collect($writers)->where('id', $post['id_user'])->first()['name'];
            $posts[$key]['image'] = Str::replace('api', 'storage', env('MEDIA_API_URL')).(Http::get(env('MEDIA_API_URL').'media/'.$post['id'])['media']['image'] ?? '');
            unset($posts[$key]['id_user']);
            unset($posts[$key]['updated_at']);
        }
        return view('User.index', compact('posts', 'categories'));
    }
}
