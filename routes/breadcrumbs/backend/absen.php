<?php

Breadcrumbs::for('admin.absens.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_absens.labels.management'), route('admin.absens.index'));
});

Breadcrumbs::for('admin.absens.create', function ($trail) {
    $trail->parent('admin.absens.index');
    $trail->push(__('backend_absens.labels.create'), route('admin.absens.create'));
});

Breadcrumbs::for('admin.absens.show', function ($trail, $id) {
    $trail->parent('admin.absens.index');
    $trail->push(__('backend_absens.labels.view'), route('admin.absens.show', $id));
});

Breadcrumbs::for('admin.absens.edit', function ($trail, $id) {
    $trail->parent('admin.absens.index');
    $trail->push(__('backend.absens.labels.edit'), route('admin.absens.edit', $id));
});

Breadcrumbs::for('admin.absens.deleted', function ($trail) {
    $trail->parent('admin.absens.index');
    $trail->push(__('backend_absens.labels.deleted'), route('admin.absens.deleted'));
});
