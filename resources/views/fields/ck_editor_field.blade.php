<!-- resources/views/fields/media_library.blade.php -->
<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
    <div class="col-lg-12 mb-2 mt-2">
        <h4 class="card-title">{{ucfirst($options['name'] ?? 'Description')}}</h4>
        <textarea class="elm1" name="{{$options['name'] ?? 'description'}}">
                        {{ old('description', $options['description'] ?? '') }}

        </textarea>
    </div>
    @if ($errors->has($name))
        <span class="help-block">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif

</div>
