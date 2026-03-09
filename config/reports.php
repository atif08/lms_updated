<?php

use App\AmazonReports\MYIInventoryReport;
use App\AmazonReports\MerchantListingsReport;
use App\Enums\UserTypeEnum;
use App\Models\AmazonReports\AmazonReport;

return [
    AmazonReport::GET_MERCHANT_LISTINGS_DATA => [
        'report_type'    => 'GET_MERCHANT_LISTINGS_DATA',
        'class'          => MerchantListingsReport::class,
        'type'           => UserTypeEnum::SELLER(),
        'real_time'      => true
    ],
    AmazonReport::GET_FBA_MYI_ALL_INVENTORY_DATA => [
        'report_type'    => 'GET_FBA_MYI_ALL_INVENTORY_DATA',
        'class'          => MYIInventoryReport::class,
        'type'           => UserTypeEnum::SELLER(),
        'real_time'      => true
    ],
];
