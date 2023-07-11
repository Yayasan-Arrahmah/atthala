<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">

            <li class="nav-title">
                Keuangan Tahsin
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/tahsin/peserta-ujian') ? 'active' : '' }} "
                href="{{ route('admin.tahsins.pesertaujian') }}
                " > <i class="nav-icon fas fa-user-check"></i>
                Daftar Ujian
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/tahsin/daftar-ulang') ? 'active' : '' }} "
                href="{{ route('admin.tahsins.daftarulang') }}
                " > <i class="nav-icon fas fa-user-check"></i>
                Daftar ulang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/tahsin/daftar-baru') ? 'active' : '' }} "
                href="{{ route('admin.tahsins.daftarbaru') }}
                " > <i class="nav-icon fas fa-user-plus"></i>
                Daftar Baru
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/tahsin') ? 'active' : '' }} "
                href="{{ route('admin.tahsins.index') }}
                " > <i class="nav-icon fas fa-users"></i>
                Peserta
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/tahsin/pembayaran') ? 'active' : '' }} "
                href="{{ route('admin.tahsins.pembayaran') }}
                " > <i class="nav-icon fas fa-credit-card"></i>
                Pembayaran
                </a>
            </li>

        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
