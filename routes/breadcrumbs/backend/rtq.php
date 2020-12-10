<?php

Breadcrumbs::for('admin.rtqs.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('RTQ', route('admin.rtqs.index'));
});

Breadcrumbs::for('admin.rtqs.create', function ($trail) {
    $trail->parent('admin.rtqs.index');
    $trail->push('Tambah Santri', route('admin.rtqs.create'));
});

Breadcrumbs::for('admin.rtqs.show', function ($trail, $id) {
    $trail->parent('admin.rtqs.index');
    $trail->push('Data Santri', route('admin.rtqs.show', $id));
});

Breadcrumbs::for('admin.rtqs.edit', function ($trail, $id) {
    $trail->parent('admin.rtqs.index');
    $trail->push('Edit Data Santri', route('admin.rtqs.edit', $id));
});

Breadcrumbs::for('admin.rtqs.deleted', function ($trail) {
    $trail->parent('admin.rtqs.index');
    $trail->push('Santri Non Aktif', route('admin.rtqs.deleted'));
});

Breadcrumbs::for('admin.rtqs.rapor', function ($trail) {
    $trail->parent('admin.rtqs.index');
    $trail->push('Rapor Santri', route('admin.rtqs.rapor'));
});
