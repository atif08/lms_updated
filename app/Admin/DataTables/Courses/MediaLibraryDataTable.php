<?php

namespace App\Admin\DataTables\Courses;

use App\Admin\DataTables\BaseDataTable;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaLibraryDataTable extends BaseDataTable
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

        return Media::query()
            ->select('*');

    }

    public function getColumnDef(): array
    {

        return [

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
            'action' => [
                'title' => __('Action'),
                'data' => 'action',
                'name' => 'action',
                'searchable' => false,
                'orderable' => false,
                'raw' => 'true',
                'content' => function ($row) {
                    $actions = [
                        $relativePath = str_replace(storage_path('app/public/'), '', $row->getPath()),
                        $url = url('storage/'.$relativePath), // Generate the correct URL
                        //                        '<a class="btn btn-danger btn-sm" href="' . route('file-libraries.delete',$row->id)  . '"><i class="fas fa-trash-alt"></i> </a>',
                        '<button type="button" class="btn btn-primary select-media"
                                                data-media-id="'.$row->id.'"
                                                data-media-thumbnail-url="'.$url.'">Select</button>',
                    ];

                    return implode(' ', $actions);
                },
            ],
        ];

    }
}
