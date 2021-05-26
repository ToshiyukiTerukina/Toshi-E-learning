@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h3>Dashboard</h3>
            <div class="media my-2">
                <img src="{{ asset('image/user.png') }}" style="width:40px;">
                <div class="media-body ml-2">
                    <h5>{{ $user->first_name }}</h5>
                    <p>Learned {{ count($learned_words) }} Words</p>
                    <p>Learned {{ $learned_lessons->count() }} Lessons</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2>Activities</h2>
                    @foreach ($activities as $activity)
                        <div class="media my-2">
                            <img src="{{ asset('image/user.png') }}" style="width:40px;">
                            <div class="media-body ml-2">
                                <h5>
                                    @if ($activity->user == $user)
                                        You
                                    @else
                                        <a href="{{ route('user.index', ['id' => $activity->user->id]) }}">{{ $activity->user->first_name }}</a>
                                    @endif


                                    @if ($activity->activity_type == 'App\Relationship')
                                        followed <a href="{{ route('user.index', ['id' => $activity->activity->following->id]) }} ">{{ $activity->activity->following->first_name}}</a>
                                    @elseif ($activity->activity_type == 'App\Lesson')
                                        took {{ $activity->activity->category->title}}
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
