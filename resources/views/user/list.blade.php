@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @foreach ($users as $user)
                <div class="card text-center my-3">
                    <div class="card-body">
                        <img src="{{ asset('image/user.png') }}" style="width:30px;">
                        <div><a href="{{ route('user.index', ['id' => $user->id]) }}">{{ $user->first_name }}</a></div>

                        @if ($user->id != Auth::id())

                            @if (Auth::user()->is_following($user->id))
                                <form method="POST" action="{{ route('unfollow', ['id' => $user->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Unfollow</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('follow', ['id' => $user->id]) }}">
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
