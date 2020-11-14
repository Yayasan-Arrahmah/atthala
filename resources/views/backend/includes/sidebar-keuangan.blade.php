<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">

            <li class="nav-title">
                Keuangan Tahsin
            </li>
            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/tahsin')) }} "
                href="{{ route('admin.tahsins.index') }}
                " > <i class="nav-icon fas fa-users"></i>
                Peserta Tahsin
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/tahsin/peserta-ujian')) }} "
                href="{{ route('admin.tahsins.pesertaujian') }}
                " > <i class="nav-icon fas fa-edit"></i>
                Peserta Ujian
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/tahsin/peserta-daftar-ulang')) }} "
                {{-- href="{{ route('admin.tahsins.pesertadaftarulang') }} --}}
                " > <i class="nav-icon fas fa-check"></i>
                Peserta Daftar Ulang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/tahsin/pembayaran')) }} "
                href="{{ route('admin.tahsins.pembayaran') }}
                " > <i class="nav-icon fas fa-credit-card"></i>
                Pembayaran
                </a>
            </li>

        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
