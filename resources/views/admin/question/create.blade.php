@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-body">
                    <p><span style="font-size : 30px;">Add a Question</span></p>
                    <form method="POST" action="{{ route('admin.question.create', ['category_id' => $category->id]) }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="question_text" class="col-md-4 col-form-label text-md-right">{{ __('Question Text') }}</label>
                                    <input id="question_text" type="question_text" class="form-control @error('question_text') is-invalid @enderror" name="question_text" value="{{ old('question_text') }}" required autocomplete="question_text" autofocus>

                                    @error('question_text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{-- choice1 --}}
                                    <label for="choice1" class="col-md-4 col-form-label text-md-right">{{ __('Choice1') }}</label>
                                    <input id="choice1" type="choice1" class="form-control @error('choice1') is-invalid @enderror" name="choice1" value="{{ old('choice1') }}" required autocomplete="choice1" autofocus>

                                    @error('choice1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio_choice" id="choice1" value="1" checked>
                                        <label class="form-check-label" for="choice1">Correct Answer</label>
                                    </div>

                                    {{-- choice2 --}}
                                    <label for="choice2" class="col-md-4 col-form-label text-md-right">{{ __('Choice2') }}</label>
                                    <input id="choice2" type="choice2" class="form-control @error('choice2') is-invalid @enderror" name="choice2" value="{{ old('choice2') }}" required autocomplete="choice2" autofocus>

                                    @error('choice2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio_choice" id="choice2" value="2">
                                        <label class="form-check-label" for="choice2">Correct Answer</label>
                                    </div>

                                    {{-- choice3 --}}
                                    <label for="choice3" class="col-md-4 col-form-label text-md-right">{{ __('Choice3') }}</label>
                                    <input id="choice3" type="choice3" class="form-control @error('choice3') is-invalid @enderror" name="choice3" value="{{ old('choice3') }}" required autocomplete="choice3" autofocus>

                                    @error('choice3')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio_choice" id="choice3" value="3">
                                        <label class="form-check-label" for="choice3">Correct Answer</label>
                                    </div>

                                    {{-- choice4 --}}
                                    <label for="choice4" class="col-md-4 col-form-label text-md-right">{{ __('Choice4') }}</label>
                                    <input id="choice4" type="choice4" class="form-control @error('choice4') is-invalid @enderror" name="choice4" value="{{ old('choice4') }}" required autocomplete="choice4" autofocus>

                                    @error('choice4')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio_choice" id="choice4" value="4">
                                        <label class="form-check-label" for="choice4">Correct Answer</label>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Create Questtion') }}
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
