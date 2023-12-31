@extends('User.layout.app')
@section('Css')

@endsection
@section('Content')
    <div class="post">
        <h1 class="title my-1">{{ $post['title'] }}</h1>
        <img src="{{ $postImg }}" alt="post-img" class="img-fluid w-100" style="object-fit: cover;"/>
        <p class="body">
            {{ $post['body'] }}
        </p>
    </div>
@endsection
@section('Js')

@endsection