@extends('layouts.master')

@section('title', __('Quiz Attempt Detail'))

@section('extra-buttons')
@endsection

@section('content')
    @component('components.admin.page-title')
        @slot('li_1')
            {{ __('Settings') }}
        @endslot
        @slot('title')
            {{ __('Quiz Attempt Detail') }}
        @endslot
    @endcomponent
    @include('admin.quizzes.attempts.quiz-result-partial')
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).on('click', '.edit-question-points-modal', function () {
            const $this = $(this);
            // Update input values with the respective data attributes
            const maxPoints = $this.data('points');

            $('#points')
                .val(maxPoints)
                .attr('max', maxPoints);

            $('#question-id').val($this.data('question-id'));
            $('#question-option-id').val($this.data('question-option-id'));

            // Restrict user input to not exceed the max value
            $('#points').on('input', function() {
                const currentValue = parseFloat($(this).val());
                if (currentValue > maxPoints) {
                    $(this).val(maxPoints);
                }
            });
        });

    </script>
@endpush
