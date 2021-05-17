@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>People that are following {{ $user->first_name }}</h1>
            @foreach ($follower_list as $follower_user)
                <div class="card text-center my-3">
                    <div class="card-body">
                        <img src="{{ asset('image/user.png') }}" style="width:30px;">
                        <div><a href="{{ route('user.index', ['id' => $follower_user->id]) }}">{{ $follower_user->first_name }}</a></div>

                        @if ($follower_user->id != Auth::id())

                            @if (Auth::user()->is_following($follower_user->id))
                                <form method="POST" action="{{ route('unfollow', ['id' => $follower_user->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Unfollow</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('follow', ['id' => $follower_user->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">follow</button>
                                </form>
                            @endif
                        @endif

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
