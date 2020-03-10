<?php

Breadcrumbs::for('admin.jadwals.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_jadwals.labels.management'), route('admin.jadwals.index'));
});

Breadcrumbs::for('admin.jadwals.create', function ($trail) {
    $trail->parent('admin.jadwals.index');
    $trail->push(__('backend_jadwals.labels.create'), route('admin.jadwals.create'));
});

Breadcrumbs::for('admin.jadwals.show', function ($trail, $id) {
    $trail->parent('admin.jadwals.index');
    $trail->push(__('backend_jadwals.labels.view'), route('admin.jadwals.show', $id));
});

Breadcrumbs::for('admin.jadwals.edit', function ($trail, $id) {
    $trail->parent('admin.jadwals.index');
    $trail->push(__('backend_jadwals.labels.edit'), route('admin.jadwals.edit', $id));
});

Breadcrumbs::for('admin.jadwals.deleted', function ($trail) {
    $trail->parent('admin.jadwals.index');
    $trail->push(__('backend_jadwals.labels.deleted'), route('admin.jadwals.deleted'));
});

Breadcrumbs::for('admin.jadwals.upload', function ($trail) {
    $trail->parent('admin.jadwals.index');
    $trail->push('Upload Excel', route('admin.jadwals.upload'));
});
