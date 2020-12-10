<?php

return [
    'table' => [
        'nama_santri'    => 'nama_santri',
        'created'       => 'Created',
        'actions'       => 'Actions',
        'last_updated'  => 'Updated',
        'total'         => 'Total|Totals',
        'deleted'       => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New Rtq created',
        'updated' => 'Rtq updated',
        'deleted' => 'Rtq was deleted',
        'deleted_permanently' => 'Rtq was permanently deleted',
        'restored'  => 'Rtq was restored',
    ],

    'labels'    => [
        'management'    => 'Management of Rtq',
        'active'        => 'Active',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'nama_santri'    => 'nama_santri',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'nama_santri' => 'nama_santri',
        ]
    ],

    'sidebar' => [
        'title'  => 'Title',
    ],

    'tabs' => [
        'nama_santri'    => 'nama_santri',
        'content'   => [
            'overview' => [
                'nama_santri'    => 'nama_santri',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'Rtq',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];
