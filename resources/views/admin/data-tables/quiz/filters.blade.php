<div class="row mb-2">
    <div class="col-lg-2">
        <div class="input-group form-group">
            <select name="b.name" class="form-select batch-select">
                <option value="">{{ __('Select Batch') }}</option>
                @foreach($data_table->getFilterData()['batches'] as $batch)
                    <option value="{{ $batch->name }}">{{ $batch->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
