@extends('User.layout.app')
@section('Css')

@endsection
@section('Content')
<div class="posts mt-4" style="display: flex;gap: 30px;flex-wrap: wrap;justify-content: center;">
    @foreach($posts as $post)
        <div class="post" style="flex: 0 0 calc(33.333333% - 30px);display: flex;flex-direction: column;gap: 10px;justify-content: space-between;height: 340px;">
            <img src="{{ $post['image'] }}" alt="post-img" class="img-fluid" style="width: 100%;height: 180px;object-fit: cover;"/>
            <h1 class="title my-1" style="color: #212529;font-family: Roboto;font-size: 20px;font-style: normal;font-weight: 500;line-height: 24px;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;">{{ $post['title'] }}</h1>
            <!-- <span class="author">{{ $post['author_name'] }}</span>
            <span class="date">{{ \Carbon\carbon::parse($post['created_at'])->format('d/m/Y H:s') }}</span> -->
            <p class="body" style="color: #212529;font-family: Roboto;font-size: 15.875px;font-style: normal;font-weight: 400;line-height: 24px;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;">
                {{ $post['body'] }}
            </p>
            <a class="btn btn-success" href="{{ route('getPost', $post['id']) }}" style="width: 33%;">Voir details</a>
        </div>
    @endforeach
</div>
@endsection
@section('Js')

@endsection