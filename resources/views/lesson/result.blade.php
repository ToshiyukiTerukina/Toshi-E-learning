@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>{{ $lesson->category->title }}</h1>
            <p>{{ $lesson->category->description }}</p>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Status</th>
                        <th>Question</th>
                        <th>Your Answer</th>
                        <th>Correct Answer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lesson->answers as $answer)
                        <tr>
                            <td>
                                @if ($answer->choice->is_correct)
                                    <span style="color:green">Correct</span>
                                @else
                                    <span style="color:red">Wrong</span>
                                @endif
                             </td>
                            <td>{{ $answer->choice->word->text }}</td>
                            <td>{{ $answer->choice->text }}</td>
                            <td>{{ $answer->choice->word->choices->where('is_correct', 1)->first()->text }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
