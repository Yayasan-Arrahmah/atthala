<?php

Breadcrumbs::for('admin.tahsins.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_tahsins.labels.management'), route('admin.tahsins.index'));
});

Breadcrumbs::for('admin.tahsins.create', function ($trail) {
    $trail->parent('admin.tahsins.index');
    $trail->push(__('backend_tahsins.labels.create'), route('admin.tahsins.create'));
});

Breadcrumbs::for('admin.tahsins.show', function ($trail, $id) {
    $trail->parent('admin.tahsins.index');
    $trail->push(__('backend_tahsins.labels.view'), route('admin.tahsins.show', $id));
});

Breadcrumbs::for('admin.tahsins.edit', function ($trail, $id) {
    $trail->parent('admin.tahsins.index');
    $trail->push(__('backend.tahsins.labels.edit'), route('admin.tahsins.edit', $id));
});

Breadcrumbs::for('admin.tahsins.deleted', function ($trail) {
    $trail->parent('admin.tahsins.index');
    $trail->push(__('backend_tahsins.labels.deleted'), route('admin.tahsins.deleted'));
});

Breadcrumbs::for('admin.tahsins.upload', function ($trail) {
    $trail->parent('admin.tahsins.index');
    $trail->push('Upload Data', route('admin.tahsins.upload'));
});

Breadcrumbs::for('admin.tahsins.jadwal', function ($trail) {
    $trail->parent('admin.tahsins.index');
    $trail->push('Jadwal', route('admin.tahsins.jadwal'));
});

Breadcrumbs::for('admin.tahsins.pengajar', function ($trail) {
    $trail->parent('admin.tahsins.index');
    $trail->push('Pengajar', route('admin.tahsins.pengajar'));
});

