@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @foreach ($users as $user)
                <div class="card text-center my-3">
                    <div class="card-body">
                        <img src="../image/user.png" style="width:30px;">
                        <div>{{ $user->first_name }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
