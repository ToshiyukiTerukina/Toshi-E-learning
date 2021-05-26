@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Categories</h1>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>{{ $words->currentPage() }} / {{ $words->lastPage() }}</h1>
                @foreach ($words as $word)
                    <div class="card">
                        <div class="card-header">
                            {{ $word->text}}
                        </div>
                        <div class="card-body">
                            <form action="{{ route('quiz.answer', ['lesson' => $lesson]) }}" method="POST">
                                @foreach ($word->choices as $choice)
                                    @csrf
                                    <input type="hidden" name="next_page_url" value="{{ $words->nextPageUrl() }}">

                                    <button type="submit" name="choice_id" class="btn btn-primary" value="{{ $choice->id }}">{{ $choice->text }}</button>

                                @endforeach
                            </form>
                        </div>
                    </div>
                @endforeach

        </div>
    </div>
</div>
@endsection
