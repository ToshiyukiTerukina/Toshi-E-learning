@extends('layouts.app')

@section('content')
<div class="container">
    @include('include/admin_header', ['page' => 'Users'])

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="text-right">
                <a href="{{ route('admin.user.create') }}" class="btn btn-success">New User</a>
            </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Fisrt Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->is_admin)
                                    Admin
                                @else
                                    User
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}" class="btn btn-warning">Edit</a>
                                <form method="POST" action="{{ route('admin.user.delete', ['id' => $user->id]) }}" style="display: inline-block;">
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
