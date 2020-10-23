<?php

return [
    'table' => [
        'nama_pengajar'    => 'Nama',
        'created'       => 'Created',
        'actions'       => 'Actions',
        'last_updated'  => 'Updated',
        'total'         => 'Total|Totals',
        'deleted'       => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New Pengajar created',
        'updated' => 'Pengajar updated',
        'deleted' => 'Pengajar was deleted',
        'deleted_permanently' => 'Pengajar was permanently deleted',
        'restored'  => 'Pengajar was restored',
    ],

    'labels'    => [
        'management'    => 'Pengajar',
        'active'        => 'Active',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'nama_pengajar'    => 'nama_pengajar',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'nama_pengajar' => 'nama_pengajar',
        ]
    ],

    'sidebar' => [
        'title'  => 'Title',
    ],

    'tabs' => [
        'nama_pengajar'    => 'nama_pengajar',
        'content'   => [
            'overview' => [
                'nama_pengajar'    => 'nama_pengajar',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'Pengajar',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];
