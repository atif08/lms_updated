<div class="row">
    <div class="col-4">
        <div class="card border">
            <div style="background-color: #b4dcf0" class="card-header border-gray">
                <div class="col-12">
                    <p class="card-text green fw-bold">KE0854...</p>
                </div>
            </div>

            <div class="card-header bg-transparent border-gray">
                <div class="col-12">
                    <p class="card-text"><i  class="fas fa-box gray"></i>&nbsp;
                        &nbsp;<i style="color: green" class="fas fa-home"></i></p>
                </div>
            </div>
        </div>
        <div class="img-container">
            <img alt="" src="{{ image($row->image_url) }}" width="75" height="75" class="img-thumbnail"/>
            {{--<i class="fas fa-edit edit-icon"></i>--}}
        </div>
    </div>
    <div class="col-8">
        <div class="card border">
            <div class="card-header bg-transparent border-gray">
                <div class="col-4">
                    <p class="card-text green fw-bold">{{__('UPC:')}}</p>
                </div>
                <div class="col-12">
                    <p class="card-text">
                        <a target="_blank" href="https://www.upcitemdb.com/upc/{{ $row->upc }}">{{$row->upc}}</a> &nbsp;
                            <i class="far fas fa-arrow-right blue"></i></p>
                </div>
            </div>
            <div class="card-header bg-transparent border-gray">
                <div class="col-4">
                    <p class="card-text green fw-bold">{{__('Desc:')}}</p>
                </div>
                <div class="col-12">
                    <p class="card-text" data-toggle="popover" data-bs-trigger="hover"
                       data-bs-content="{{ $row->description }}">
                        {{ mb_substr($row->description, 0, 30) . '...' }}
                    </p>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <p class="card-text green fw-bold">Item#:</p>
                        <p class="card-text">{{ $row->item_code }}</p>
                    </div>
                    <div class="col-6">
                        <p class="card-text green fw-bold">Case UPC:</p>
                        <p class="card-text">
                            <a target="_blank" href="https://www.upcitemdb.com/upc/{{ $row->case_upc }}">{{ $row->case_upc }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


