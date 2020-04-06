<?php

Breadcrumbs::for('admin.pembayarans.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_pembayarans.labels.management'), route('admin.pembayarans.index'));
});

Breadcrumbs::for('admin.pembayarans.create', function ($trail) {
    $trail->parent('admin.pembayarans.index');
    $trail->push(__('backend_pembayarans.labels.create'), route('admin.pembayarans.create'));
});

Breadcrumbs::for('admin.pembayarans.show', function ($trail, $id) {
    $trail->parent('admin.pembayarans.index');
    $trail->push(__('backend_pembayarans.labels.view'), route('admin.pembayarans.show', $id));
});

Breadcrumbs::for('admin.pembayarans.edit', function ($trail, $id) {
    $trail->parent('admin.pembayarans.index');
    $trail->push(__('backend.pembayarans.labels.edit'), route('admin.pembayarans.edit', $id));
});

Breadcrumbs::for('admin.pembayarans.deleted', function ($trail) {
    $trail->parent('admin.pembayarans.index');
    $trail->push(__('backend_pembayarans.labels.deleted'), route('admin.pembayarans.deleted'));
});
