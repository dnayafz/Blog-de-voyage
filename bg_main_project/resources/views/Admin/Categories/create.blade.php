@extends('Admin.layout.app')
@section('Css')
    
@endsection
@section('Content')
    <div class="d-flex justify-content-between mb-4">
        <h1>new category</h1>
    </div>
    <div class="">
        <form method="POST" action="{{ route('storeCategory') }}">
            @csrf
            <div class="form-group mb-2">
                <input name="title" class="form-control" placeholder="Title" />
            </div>
            <div class="form-group">
                <button class="btn btn-success">Create</button>
            </div>
        </form>
    </div>
@endsection
@section('Js')
    
@endsection