@extends('Admin.layout.app')
@section('Css')
    
@endsection
@section('Content')
    <div class="d-flex justify-content-between mb-4">
        <h1>new category</h1>
    </div>
    <div class="">
        <form method="POST" action="{{ route('updateCategory', $category['id']) }}">
            @csrf
            <div class="form-group mb-2">
                <input name="title" class="form-control" placeholder="Title" value="{{ $category['title'] }}" />
            </div>
            <div class="form-group">
                <button class="btn btn-success">Edit</button>
            </div>
        </form>
    </div>
@endsection
@section('Js')
    
@endsection