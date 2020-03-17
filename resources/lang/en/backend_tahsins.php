<?php

return [
    'table' => [
        'uuid_tahsin'    => 'uuid_tahsin',
        'created'       => 'Created',
        'actions'       => 'Actions',
        'last_updated'  => 'Updated',
        'total'         => 'Total|Totals',
        'deleted'       => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New Tahsin created',
        'updated' => 'Tahsin updated',
        'deleted' => 'Tahsin was deleted',
        'deleted_permanently' => 'Tahsin was permanently deleted',
        'restored'  => 'Tahsin was restored',
    ],

    'labels'    => [
        'management'    => 'Management of Tahsin',
        'active'        => 'Active',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'Lihat',
        'uuid_tahsin'    => 'uuid_tahsin',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'uuid_tahsin' => 'uuid_tahsin',
        ]
    ],

    'sidebar' => [
        'title'  => 'Title',
    ],

    'tabs' => [
        'uuid_tahsin'    => 'uuid_tahsin',
        'title'    => 'Data Peserta',
        'content'   => [
            'overview' => [
                'uuid_tahsin'    => 'uuid_tahsin',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'Tahsin',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];
