@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>People that {{ $user->first_name }} is following</h1>
            @foreach ($following_list as $following_user)
                <div class="card text-center my-3">
                    <div class="card-body">
                        <img src="../image/user.png" style="width:30px;">
                        <div><a href="{{ route('user.index', ['id' => $following_user->id]) }}">{{ $following_user->first_name }}</a></div>

                        @if ($following_user->id != Auth::id())

                            @if (Auth::user()->is_following($following_user->id))
                                <form method="POST" action="{{ route('unfollow', ['id' => $following_user->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Unfollow</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('follow', ['id' => $following_user->id]) }}">
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
