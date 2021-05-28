@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="bg-light">
                            <img src="{{ asset('image/user.png') }}" style="width:130px;">
                        </div>
                        <p>{{ "$user->first_name" }}</p>
                    </div>
                    <div class="row border-top py-2">
                        <div class="col-md-6">
                            <a href="{{ route('follower.list', ['id' => $user->id]) }}">{{$user->followers->count() }}</a>
                            Followers
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('following.list', ['id' => $user->id]) }}">{{$user->following->count() }}</a>
                            Following
                        </div>
                    </div>
                    @if ($user->id == Auth::id())
                        <div class="row py-2 justify-content-center">
                            <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-primary">Edit Profile</a>
                        </div>
                    @endif

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

                    <div class="row py-2 justify-content-center">
                        Learned {{ count($learned_words) }} Lessons</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2>Activities</h2>
                    @foreach ($user->activities as $activity)
                        <div class="media my-2">
                            <img src="{{ asset('image/user.png') }}" style="width:40px;">
                            <div class="media-body ml-2">
                                <h5>
                                    @if ($activity->activity_type == 'App\Relationship')
                                        {{ $user->first_name }} followed <a href="{{ route('user.index', ['id' => $activity->activity->following->id]) }} ">{{ $activity->activity->following->first_name}}</a>
                                    @elseif ($activity->activity_type == 'App\Lesson')
                                        {{ $user->first_name }} took {{ $activity->activity->category->title}}
                                    @endif
                                </h5>
                                {{ $activity->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
