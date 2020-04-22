<?php

Breadcrumbs::for('admin.amalans.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_amalans.labels.management'), route('admin.amalans.index'));
});

Breadcrumbs::for('admin.amalans.create', function ($trail) {
    $trail->parent('admin.amalans.index');
    $trail->push(__('backend_amalans.labels.create'), route('admin.amalans.create'));
});

Breadcrumbs::for('admin.amalans.show', function ($trail, $id) {
    $trail->parent('admin.amalans.index');
    $trail->push(__('backend_amalans.labels.view'), route('admin.amalans.show', $id));
});

Breadcrumbs::for('admin.amalans.edit', function ($trail, $id) {
    $trail->parent('admin.amalans.index');
    $trail->push(__('backend.amalans.labels.edit'), route('admin.amalans.edit', $id));
});

Breadcrumbs::for('admin.amalans.deleted', function ($trail) {
    $trail->parent('admin.amalans.index');
    $trail->push(__('backend_amalans.labels.deleted'), route('admin.amalans.deleted'));
});
