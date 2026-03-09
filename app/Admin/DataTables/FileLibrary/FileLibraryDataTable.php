<?php

namespace App\Admin\DataTables\FileLibrary;

use App\DataTables\BaseDataTable;
use Domain\FileLibrary\Models\FileLibrary;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class FileLibraryDataTable extends BaseDataTable
{
    protected $order_by = [[0, 'asc']];

    public function getBaseQuery()
    {
        $this->columns = [
            'id',
            'name',
            'file_name',
            'mime_type',
            'size',
            'created_at',

        ];

        return Media::query()->with('model.uploader')->where('model_type', '=', FileLibrary::class)
            ->select('*');
    }

    public function getColumnDef(): array
    {

        return [
            'select' => [
                'title' => '<input type="checkbox" id="select-all">',
                'data' => 'select',
                'name' => 'select',
                'column_type' => 'sub_string',
                'raw' => true,
                'orderable' => false,
                'searchable' => false, // Disable ordering for this column
                'content' => function ($row) {
                    return '<input type="checkbox" name="files" class="select-item" value="'.$row->id.'">';
                },
            ],
            'id' => [
                'title' => __('UID'),
                'data' => 'id',
                'name' => 'id',
                'column_type' => 'integer',
            ],
            'name' => [
                'title' => __('Name'),
                'data' => 'name',
                'name' => 'name',
                'column_type' => 'sub_string',
                'raw' => true,
                'content' => function ($row) {
                    return $row->name ? '<a href="'.$row->getUrl().'">'.$row->name.'</a>' : '<a href="'.$row->getUrl().'">File default</a>';
                },
            ], 'size' => [
                'title' => __('Size'),
                'data' => 'size',
                'name' => 'size',
                'column_type' => 'integer',
                'raw' => true,
                'content' => function ($row) {
                    return format_bytes($row->size);
                },
            ],
            'uploaded_by' => [
                'title' => __('Uploaded By'),
                'data' => 'model.uploader',
                'name' => 'model.uploader',
                'column_type' => 'text',
                'raw' => true,
                'orderable' => false,
                'searchable' => false, // Disable ordering for this column
                'content' => function ($row) {

                    return $row->model->uploader?->name;
                },
            ],
            'created_at' => [
                'title' => __('Created At'),
                'data' => 'created_at',
                'name' => 'created_at',
                'column_type' => 'date',
            ],
            'action' => [
                'title' => __('Action'),
                'data' => 'action',
                'name' => 'action',
                'searchable' => false,
                'orderable' => false,
                'raw' => 'true',
                'content' => function ($row) {
                    $actions = [
                        '<a class="btn btn-danger delete-item btn-sm" data-url="'.route('file-libraries.destroy', $row->id).'"><i class="fas fa-trash-alt"></i> </a>',
                        '<a class="btn btn-secondary btn-sm" href="'.route('file-libraries.download', $row->id).'"><i class="fas fa-download"></i></a>',
                    ];

                    return implode(' ', $actions);
                },
            ],
        ];
    }
}
