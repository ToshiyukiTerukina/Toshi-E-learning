@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Categories</h1>

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card-deck">
            @foreach ($categories as $category)
                {{-- //if words exists --}}
                @if (!$category->words->isEmpty())
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h5>{{ $category->title }}</h5>
                            </div>
                            <div class="card-text">
                                <p>{{ $category->description }}</p>
                            </div>

                            <form method="POST" action="{{ route('lesson.index') }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                <input type="hidden" name="category_id" value="{{ $category->id }}">
                                <button type="submit" class="btn btn-primary">Take Quiz</button>

                            </form>

                        </div>
                    </div>
                @endif
            @endforeach
            </div>

        </div>
    </div>
</div>
@endsection
