<?php

return [
    'table' => [
        'id_peserta'    => 'id_peserta',
        'created'       => 'Created',
        'actions'       => 'Actions',
        'last_updated'  => 'Updated',
        'total'         => 'Total|Totals',
        'deleted'       => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New Absen created',
        'updated' => 'Absen updated',
        'deleted' => 'Absen was deleted',
        'deleted_permanently' => 'Absen was permanently deleted',
        'restored'  => 'Absen was restored',
    ],

    'labels'    => [
        'management'    => 'Management of Absen',
        'active'        => 'Active',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'id_peserta'    => 'id_peserta',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'id_peserta' => 'id_peserta',
        ]
    ],

    'sidebar' => [
        'title'  => 'Title',
    ],

    'tabs' => [
        'id_peserta'    => 'id_peserta',
        'content'   => [
            'overview' => [
                'id_peserta'    => 'id_peserta',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'Absen',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];
