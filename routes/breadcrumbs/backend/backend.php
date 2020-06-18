<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';

require __DIR__.'/jadwal.php';
require __DIR__.'/tahsin.php';
require __DIR__.'/pembayaran.php';
require __DIR__.'/amalan.php';
require __DIR__.'/absen.php';