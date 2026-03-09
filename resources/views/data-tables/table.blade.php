<table class="table table-hover datatable w-100 {{ $attributes['class'] ?? '' }}" id="{{ $data_table->getTableId() }}">
    <thead>
        <tr>
            @foreach($data_table->getColumnDef() as $key => $value)
                <th scope="col" class="{{ $key }}">{{ $value['title'] }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody></tbody>
</table>
