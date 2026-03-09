<?php

use App\Enums\ReportTypeEnum;
use App\Importers\SupplierSheetsImporter;
use App\Importers\UPCsImporter;

return [
    ReportTypeEnum::UPCS()->value           => [
        'processor' => UPCsImporter::class,
        'headers'   => [
            'upc'  => [
                'label'       => 'UPC',
                'sheet_title' => 'UPC',
                'required'    => true,
            ],
            'asin' => [
                'label'       => 'ASIN',
                'sheet_title' => 'ASIN',
                'required'    => true,
            ]
        ],
    ],
    ReportTypeEnum::SUPPLIER_SHEET()->value => [
        'processor' => SupplierSheetsImporter::class,
        'headers'   => [
            'upc'              => [
                'label'       => 'UPC',
                'sheet_title' => 'UPC',
                'required'    => true,
            ],
            'item_code'        => [
                'label'       => 'Item Code',
                'sheet_title' => 'ITEM CODE',
                'required'    => true,
            ],
            'item_description' => [
                'label'       => 'Item Description',
                'sheet_title' => 'ITEM DESCRIPTION',
                'required'    => true,
            ],
            'case_pack'        => [
                'label'       => 'Case Pack',
                'sheet_title' => 'CASE PACK',
                'required'    => true,
            ],
            'net_unit_cost'    => [
                'label'       => 'Net Unit Cost',
                'sheet_title' => 'NET UNIT COST',
                'required'    => true,
            ],
            'net_case_cost'    => [
                'label'       => 'Net Case Cost',
                'sheet_title' => 'NET CASE COST',
            ],
        ],
    ],
];
