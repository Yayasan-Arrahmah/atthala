<?php

namespace App\Http\Controllers\Backend\Tahsin;

use App\Http\Controllers\Controller;

class PengaturanController extends Controller
{
    public function index() {
        return view('backend.pendidikan.tahsin.pengaturan');
    }
}
