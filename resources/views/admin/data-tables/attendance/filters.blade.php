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
    <div class="col-lg-2">
        <div class="input-group form-group">
            <select name="u.name" class="form-select batch-select">
                <option value="">{{ __('Select User') }}</option>
                @foreach($data_table->getFilterData()['users'] as $user_item)
                    <option value="{{ $user_item->name }}">{{ $user_item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 d-flex align-items-center gap-2">
        @include('components.admin.date-range', ['filter_column' => 'date'])
        <button class="btn btn-primary export-block">
            <span class="fas fa-download"></span> {{ __('Export') }}
        </button>
        <a href="{{ route('attendances.create') }}" class="btn btn-primary">
            <span class="fas fa-plus"></span> {{ __('Attendance') }}
        </a>
    </div>
</div>
