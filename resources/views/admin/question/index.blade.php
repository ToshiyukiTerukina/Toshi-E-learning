@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="col-md-6 text-center mx-auto">
                <div class="card">
                    <div class="card-body">
                        <p><span style="font-size : 30px;">{{ $category->title }}</span></p>
                        <p>{{ $category->description }}</p>
                        <a href="{{ route('admin.dashboard', ['category_id' => $category->id]) }}" class="btn btn-success">Categories</a>
                    </div>
                </div>
            </div>


            <div class="text-right">
                <a href="{{ route('admin.question.create', ['category_id' => $category->id]) }}" class="btn btn-success">Add a Question</a>
            </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Question</th>
                        <th>Choice</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($words as $word)
                        <tr>
                            <td>{{ $word->id }}</td>
                            <td>{{ $word->text }} </td>
                            <td>
                                @foreach ($word->choices as $choice)
                                    @if ($choice->is_correct)
                                        <span style='color: green;'>{{ $choice->text }}</span>
                                    @else
                                        {{ $choice->text }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('admin.question.edit', ['category_id' => $category->id, 'question_id' => $word->id]) }}" class="btn btn-warning">Edit</a>
                                <form method="POST" action="{{ route('admin.question.delete', ['category_id' => $category->id, 'question_id' => $word->id]) }}" style="display: inline-block;">
                                    @csrf
                                    <button class="btn btn-danger">Delete</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
