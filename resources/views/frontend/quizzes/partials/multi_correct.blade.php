@foreach($question->options as $option)
    <div class="col-md-6 p-2">
        <div class="form-check border p-3 rounded">
            <label class="form-check rounded d-block"
                   for="option_{{ $option->id }}">
                <input class="form-check-input" type="checkbox"
                       name="multi_answers[{{ $question->id }}][]"
                       value="{{ $option->id }}"
                       id="option_{{ $option->id }}">
                {{ $option->name }}
            </label>
        </div>
    </div>
@endforeach
