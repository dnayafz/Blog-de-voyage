@extends('Admin.layout.app')
@section('Css')
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection
@section('Content')
    <div class="d-flex justify-content-between mb-4">
        <h1>Posts</h1>
        <a class="btn btn-success" href="{{ route('addPost') }}">Create</a>
    </div>
    <table id="posts" class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>image</th>
                <th>title</th>
                <th>category</th>
                <th>body</th>
                <th>Status</th>
                <th>Settings</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post['id'] }}</td>
                <td>
                    <img src="{{ $post['image'] }}" alt="Image post" style="width: 114px;height: 78px;"/>
                </td>
                <td>{{ $post['title'] }}</td>
                <td>{{ $post['category'] }}</td>
                <td>{{ $post['body'] }}</td>
                <td>
                    @if($post['status'])
                        <span class="text-success">enable</span>
                    @else
                        <span class="text-danger">disable</span>
                    @endif
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('viewPost', $post['id']) }}">View</a>
                    <a class="btn btn-warning" href="{{ route('editPost', $post['id']) }}">Edit</a>
                    <a class="btn btn-danger" href="{{ route('deletePost', $post['id']) }}">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('Js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        new DataTable('#posts');
    </script>
@endsection