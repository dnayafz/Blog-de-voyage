@extends('Admin.layout.app')
@section('Css')
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection
@section('Content')
    <div class="d-flex justify-content-between mb-4">
        <h1>Catgeories</h1>
        <a class="btn btn-success" href="{{ route('addCategory') }}">Create</a>
    </div>
    <table id="categories" class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>name</th>
                <th>Settings</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category['id'] }}</td>
                <td>{{ $category['title'] }}</td>
                <td>
                    <a class="btn btn-warning" href="{{ route('editCategory', $category['id']) }}">Edit</a>
                    <a class="btn btn-danger" href="{{ route('deleteCategory', $category['id']) }}">Delete</a>
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
        new DataTable('#categories');
    </script>
@endsection