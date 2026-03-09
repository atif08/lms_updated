@extends('layouts.master')
@section('title', __('Question'))
@section('content')
    @component('components.admin.page-title')
        @slot('li_1')
            {{ __('Settings') }}
        @endslot
        @slot('title')
            {{ __('Question') }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">{{ __('Basic Info') }}</h4>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ ($question->id)
                             ? route('quizzes.questions.update', ['quiz' => $quiz->id, 'question' => $question->id])
                             : route('quizzes.questions.store', ['quiz' => $quiz->id]) }}" accept-charset="UTF-8" role="form" class="row">
                        <input  type="hidden" name="answer_status[]" value="1">
                        <input type="hidden" name="answer[]"  value="FREE TEXT">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if($question->id)
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <div class="col-lg-12 mb-2 mt-2">
                                <h4 class="card-title">Section*</h4>
                                <input type="hidden" name="type" value="{{$question_type ?? $question->type  }}">
                                <select name="quiz_section_id" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($quiz_sections as $section)
                                        <option value="{{ $section->id }}" {{ (old('quiz_section_id', $question->quiz_section_id ?? '') == $section->id) ? 'selected' : '' }}>
                                            {{ $section->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('quiz_section_id')
                                <p class="has-error red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 mb-2 mt-2">
                                <h4 class="card-title">Enter your question*</h4>
                                <textarea class="elm1 ck_editor" name="name" id="mce_33" aria-hidden="true">
                                    {{ old('name', $question->name ?? '') }}
                                </textarea>
                                @error('name')
                                <p class="has-error red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 mb-2 mt-2">
                                <h4 class="card-title">Points*</h4>
                                <input class="form-control" name="points" value="{{ old('points', $question->points ?? '') }}" type="number" required/>
                                @error('points')
                                <p class="has-error red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-2 mb-2">
                            <button class="btn btn-success btn-supplier-save" type="submit" id="sectionSave"><span
                                    class="fa fa-save"></span> Save
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
