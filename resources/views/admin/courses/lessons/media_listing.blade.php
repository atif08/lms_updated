<div class="search-box mb-2">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <input type="text" placeholder="Search Name" id="mediaSearchInput" class="form-control">
            </div>
        </div>
    </div>
</div>
<table class="table" id="mediaTable">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Size</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($medias) && count($medias) > 0)
        @foreach($medias as $media)

            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td class="media-name">{{ $media->file_name }}</td>
                <td>{{ format_bytes($media->size) }}</td>
                <td>
                    @php
                        $relativePath = str_replace(storage_path('app/public/'), '', $media->getPath());
                        $url = url('storage/' . $relativePath); // Generate the correct URL
                    @endphp
                    <button type="button" class="btn btn-primary select-media"
                            data-media-id="{{ $media->id }}"
                            data-media-thumbnail-url="{{ $url }}">Select</button>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="4">No media available</td>
        </tr>
    @endif
    </tbody>
</table>
