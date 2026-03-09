<!-- resources/views/fields/media_library.blade.php -->
{{--@dd($options['item']->getFirstMedia('avatar'))--}}
@php
    $input_name = $options['name'];
@endphp
<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
    <label for="Select" class="control-label">Select {{\Illuminate\Support\Str::title($input_name)}} </label>
    <select class="select2 form-control select2-multiple" name="{{$input_name}}[]" multiple="multiple" data-placeholder="Choose ...">
        @foreach($options['items'] as $item)
            <option value="{{ $item->id }}" {{ in_array($item->id, $options['ids']) ? 'selected' : '' }}>
                {{ $item->name }}
            </option>
        @endforeach
    </select>
   @if($input_name == 'user_ids')  <span>Leave blank to select all students</span> @endif
    @if ($errors->has($name))
        <span class="help-block">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>


