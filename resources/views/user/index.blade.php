@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="bg-light">
                            <img src="../image/user.png" style="width:130px;">
                        </div>
                        <p>{{ "$user->first_name" }}</p>
                    </div>
                    <div class="row border-top py-2">
                        <div class="col-md-6">
                            Followers
                        </div>
                        <div class="col-md-6">
                            Following
                        </div>
                    </div>
                    <div class="row py-2 justify-content-center">
                        <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-primary">Edit Profile</a>
                    </div>
                    <div class="row py-2 justify-content-center">
                        Learnd hoge words
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2>Activities</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection