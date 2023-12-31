@extends('Admin.layout.app')
@section('Css')
    
@endsection
@section('Content')
    <div class="d-flex justify-content-between mb-4">
        <h1>edit post</h1>
    </div>
    <div class="">
        <form method="POST" action="{{ route('updatePost', $post['id']) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-2">
                <input name="title" class="form-control" placeholder="Title" value="{{ $post['title'] }}"/>
            </div>
            <div class="form-group mb-2">
                <textarea name="body" class="form-control" placeholder="Body">{{ $post['body'] }}</textarea>
            </div>
            <div class="form-group mb-2">
                <label>Category</label>
                <select name="category" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category['id'] }}" @if($post['id_category'] == $category['id']) selected @endif>{{ $category['title'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-2">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1" @if($post['status'] == 1) selected @endif>enable</option>
                    <option value="0" @if($post['status'] == 0) selected @endif>disable</option>
                </select>
            </div>
            <div class="form-group mb-2">
                <label>Image</label>
                <input name="image" type="file" class="form-control" placeholder="Image" />
            </div>
            <div class="form-group">
                <button class="btn btn-success">edit</button>
            </div>
        </form>
    </div>
@endsection
@section('Js')
    
@endsection