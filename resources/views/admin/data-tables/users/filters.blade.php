<div class="row mb-2">
    <div class="col-lg-2">
        <div class="input-group form-group">
            <input type="text" name="query" class="form-control dt-search" placeholder="{{ __('Search') }}">
        </div>
    </div>
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
    <div class="col-lg-2">
        <div class="input-group form-group">
            <select name="c.name" class="form-select batch-select">
                <option value="">{{ __('Select Course') }}</option>
                @foreach($data_table->getFilterData()['courses'] as $course)
                    <option value="{{ $course->name }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 d-flex align-items-center gap-2">
        @include('components.admin.date-range', ['filter_column' => 'u.created_at'])
        <button class="btn btn-primary export-block">
            <span class="fas fa-download"></span> {{ __('Export') }}
        </button>
    </div>
</div>
