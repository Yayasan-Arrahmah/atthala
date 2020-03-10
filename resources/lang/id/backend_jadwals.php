<?php

return [
    'table' => [
        'id'    => 'id',
        'created'       => 'Created',
        'actions'       => 'Actions',
        'last_updated'  => 'Updated',
        'total'         => 'Total|Totals',
        'deleted'       => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New Jadwal created',
        'updated' => 'Jadwal updated',
        'deleted' => 'Jadwal was deleted',
        'deleted_permanently' => 'Jadwal was permanently deleted',
        'restored'  => 'Jadwal was restored',
    ],

    'labels'    => [
        'management'    => 'Jadwal',
        'active'        => 'Keseluruhan',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'id'    => 'id',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'id' => 'id',
        ]
    ],

    'sidebar' => [
        'title'  => 'Title',
    ],

    'tabs' => [
        'id'    => 'id',
        'content'   => [
            'overview' => [
                'id'    => 'id',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'Jadwal',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];
