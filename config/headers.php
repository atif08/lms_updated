<?php

return [
    'sku'                 => [
        'SKU',
        'seller-sku',
        mb_convert_encoding('Händler-SKU', 'ISO-8859-1', 'UTF-8'),
        'Händler-SKU',
        mb_convert_encoding('卖家 SKU', 'ISO-8859-1', 'UTF-8'),
        '卖家 SKU',
        'SKU venditore',
        'sku-vendeur',
        '出品者SKU',
        'SKU del vendedor'
    ],
    'product_id'          => [
        'product-id',
        'Produkt-ID',
        mb_convert_encoding('商品编码', 'ISO-8859-1', 'UTF-8'),
        '商品编码',
        '商品ID',
        'Identificativo del prodotto',
        'id-produit',
        'Identificador del producto'
    ],
    'product_id_type'     => [
        'product-id-type',
        'Produkt-ID-Typ',
        mb_convert_encoding('商品编码类型', 'ISO-8859-1', 'UTF-8'),
        '商品编码类型',
        'Tipo di identificativo del prodotto',
        'type-id-produit',
        '商品IDタイプ',
        'Tipo de identificador de producto'
    ],
    'asin'                => [
        'ASIN',
        'asin1',
        'ASIN 1',
        'ASIN1'
    ],
    'fulfillment_channel' => [
        'fulfilment-channel',
        'fulfillment-channel',
        'Versender',
        mb_convert_encoding('配送渠道', 'ISO-8859-1', 'UTF-8'),
        '配送渠道',
        'Canale di gestione',
        'canal-traitement',
        'フルフィルメント・チャンネル',
        'Canal de gestión logística'
    ],
    'item_name'           => [
        'item-name',
        'Artikelbezeichnung',
        mb_convert_encoding('商品名称', 'ISO-8859-1', 'UTF-8'),
        '商品名称',
        'Nome dell\'articolo',
        'nom-produit',
        '商品名',
        'Título del producto'
    ],
    'item_description'    => [
        'item-description',
        //'コンディション説明',
    ],
    'item_condition'      => [
        'item-condition',
        'Artikelzustand',
        mb_convert_encoding('商品备注', 'ISO-8859-1', 'UTF-8'),
        '商品备注',
        'Condizione dell\'articolo',
        'état-produit',
        mb_convert_encoding('état-produit', 'ISO-8859-1', 'UTF-8'),
        'コンディション',
        'Estado del producto'
    ],
    'price'               => [
        'price',
        'Prezzo',
        'Price',
        'Preis',
        '価格',
    ],
    'status'              => [
        'status',
        'Status',
        'stato',
        'état',
        mb_convert_encoding('état', 'ISO-8859-1', 'UTF-8'),
        'ステータス',
        '状态',
        'estado'
    ],
    'open_date'           => [
        'open-date',
        'Erstellungsdatum',
        'Fecha de creación',
        '出品日',
        'Data di creazione',
        mb_convert_encoding('开售日期', 'ISO-8859-1', 'UTF-8'),
    ],
    'quantity'            => [
        'Menge',
        'quantity',
        mb_convert_encoding('数量', 'ISO-8859-1', 'UTF-8'),
        '数量',
        'Quantità',
        mb_convert_encoding('Quantità', 'ISO-8859-1', 'UTF-8'),
    ],
    'pending_quantity' => [
        'pending-quantity'
    ]
];
