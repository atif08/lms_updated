<!-- resources/views/fields/media_library.blade.php -->
{{--@dd($options['item']->getMedia('avatar'))--}}
<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}" id="{{(isset($options['id']))?$options['id']:''}}">
    <label for="Select File" class="control-label">Select File</label>
    <x-media-library-collection max-items="10" collection="{{$options['item']->media[0]->collection_name??''}}" name="media" :model="$options['item']" />

    @if ($errors->has($name))
        <span class="help-block">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif

</div>
