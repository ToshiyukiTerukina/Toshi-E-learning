@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-body">
                    <p><span style="font-size : 30px;">Editting Question</span></p>
                    <form method="POST" action="{{ route('admin.question.edit', ['category_id' => $category->id, 'question_id' => $word->id]) }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="question_text" class="col-md-4 col-form-label text-md-right">{{ __('Question Text') }}</label>
                                    <input id="question_text" type="question_text" class="form-control @error('question_text') is-invalid @enderror" name="question_text" value="{{ old('question_text', $word->text) }}" required autocomplete="question_text" autofocus>

                                    @error('question_text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">

                                    @foreach ($choices as $key => $choice)
                                        <label for="choice{{ $key + 1 }}" class="col-md-4 col-form-label text-md-right">{{ __('Choice') }}{{ $key + 1 }}</label>
                                        <input id="choice{{ $key + 1 }}" type="choice{{ $key + 1 }}" class="form-control @error('choice'){{ $key + 1 }} is-invalid @enderror"  name="choice{{ $key + 1 }}" value="{{ old("", $choice->text) }}" required autocomplete="choice{{ $key + 1 }}" autofocus>

                                        @error('choice{{ $key + 1 }}')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="radio_choice" id="choice{{ $key + 1 }}" value="{{ $key+1 }}" {{ old('', $choice->is_correct) == 1 ? "checked" : "" }}>
                                            <label class="form-check-label" for="choice{{ $key + 1 }}">Correct Answer</label>
                                        </div>
                                    @endforeach

                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Update') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
