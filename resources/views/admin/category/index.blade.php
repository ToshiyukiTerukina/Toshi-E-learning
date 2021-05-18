@extends('layouts.app')

@section('content')
<div class="container">
    @include('include/admin_header', ['page' => 'Categories'])

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="text-right">
                <a href="{{ route('admin.category.create') }}" class="btn btn-success">New Category</a>
            </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}" class="btn btn-warning">Edit</a>
                                <form method="POST" action="{{ route('admin.category.delete', ['id' => $category->id]) }}" style="display: inline-block;">
                                    @csrf
                                    <button class="btn btn-danger">Delete</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
