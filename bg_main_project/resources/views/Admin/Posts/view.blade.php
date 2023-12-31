@extends('Admin.layout.app')
@section('Css')

@endsection
@section('Content')
    <div class="post">
        <h1>{{ $post['title'] }}</h1>
        <div class="d-flex" style="gap: 10px">
            <img src="{{ $postImg }}" alt="img" style="width: 497px;height: 497px;object-fit: cover;"/>
            <p>
                {{ $post['body'] }}
            </p>
        </div>
    </div>
@endsection
@section('Js')
    
@endsection