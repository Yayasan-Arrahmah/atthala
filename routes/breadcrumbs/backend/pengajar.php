<?php

Breadcrumbs::for('admin.pengajars.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_pengajars.labels.management'), route('admin.pengajars.index'));
});

Breadcrumbs::for('admin.pengajars.create', function ($trail) {
    $trail->parent('admin.pengajars.index');
    $trail->push(__('backend_pengajars.labels.create'), route('admin.pengajars.create'));
});

Breadcrumbs::for('admin.pengajars.show', function ($trail, $id) {
    $trail->parent('admin.pengajars.index');
    $trail->push(__('backend_pengajars.labels.view'), route('admin.pengajars.show', $id));
});

Breadcrumbs::for('admin.pengajars.edit', function ($trail, $id) {
    $trail->parent('admin.pengajars.index');
    $trail->push(__('backend.pengajars.labels.edit'), route('admin.pengajars.edit', $id));
});

Breadcrumbs::for('admin.pengajars.deleted', function ($trail) {
    $trail->parent('admin.pengajars.index');
    $trail->push(__('backend_pengajars.labels.deleted'), route('admin.pengajars.deleted'));
});
