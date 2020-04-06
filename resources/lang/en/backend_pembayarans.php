<?php

return [
    'table' => [
        'uuid_pembayaran'    => 'uuid_pembayaran',
        'created'       => 'Created',
        'actions'       => 'Actions',
        'last_updated'  => 'Updated',
        'total'         => 'Total|Totals',
        'deleted'       => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New Pembayaran created',
        'updated' => 'Pembayaran updated',
        'deleted' => 'Pembayaran was deleted',
        'deleted_permanently' => 'Pembayaran was permanently deleted',
        'restored'  => 'Pembayaran was restored',
    ],

    'labels'    => [
        'management'    => 'Management of Pembayaran',
        'active'        => 'Active',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'uuid_pembayaran'    => 'uuid_pembayaran',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'uuid_pembayaran' => 'uuid_pembayaran',
        ]
    ],

    'sidebar' => [
        'title'  => 'Title',
    ],

    'tabs' => [
        'uuid_pembayaran'    => 'uuid_pembayaran',
        'content'   => [
            'overview' => [
                'uuid_pembayaran'    => 'uuid_pembayaran',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'Pembayaran',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];
