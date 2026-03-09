@foreach($question->options as $option)
    <div class="row">
        <div class="col-md-6 p-2">
            <div class="form-check border p-3 rounded">
                {{ $option->name }}
            </div>
        </div>
        <div class="col-md-6 p-2">
            <div class="drop custom-height-drop">
{{--                <span style="margin: 20px">Drop here: </span>--}}
            </div>
        </div>
    </div>
@endforeach
<div class="drop">
    @foreach($question->options->shuffle() as $option)
        <input class="btn btn-primary my-2 px-2 dragdrop" type="text" name="matching_answers[{{$question->id}}][]"
               value="{{$option->answer}}">
    @endforeach
</div>
@push('scripts')
    <script>
        $(function () {
            // Make the draggable items
            function makeDraggable() {
                $('.dragdrop').draggable({
                    revert: true,
                    placeholder: true,
                    droptarget: '.drop',
                    drop: function (evt, droptarget) {
                        // Check if the droptarget already contains a draggable item

                        if ($(droptarget).find('.dragdrop').length === 0) {
                            // Move the draggable into the drop target
                            $(droptarget).find('p').remove();

                            $(this).appendTo(droptarget).css({top: 0, left: 0});
                            // Reinitialize draggable so it can be moved again
                            makeDraggable();
                        } else {
                            // If already has an item, revert to original position
                            $(this).draggable('option', 'revert', true);
                        }
                    },
                    out: function(event, ui) {
                        // When an item is dragged out, add the 'Drop here' tag back
                        if ($(this).find('.dragdrop').length === 0) {
                            $(this).append('<p>Drop here</p>');
                        }
                    }
                });
            }
            // Initialize draggable functionality
            makeDraggable();
        });
    </script>

@endpush
