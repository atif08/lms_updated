<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
    <label class="control-label">{{ $options['label'] ?? __('Avatar') }}</label>
    <x-media-library-collection
        max-items="1"
        name="media"
        collection="avatar"
        :model="$options['item']"
    />
    @if ($errors->has($name))
        <span class="help-block">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>
