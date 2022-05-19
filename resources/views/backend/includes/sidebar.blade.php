    <div class="sidebar">

    @if (auth()->user()->last_name === 'Ekonomi')
        <nav class="sidebar-nav">
            <ul class="nav">

                <li class="nav-title">
                    Keuangan Tahsin
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/tahsin/peserta-ujian')) }} "
                    href="{{ route('admin.tahsins.pesertaujian') }}
                    " > <i class="nav-icon fas fa-user-check"></i>
                    Daftar Ujian
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/tahsin/daftar-ulang')) }} "
                    href="{{ route('admin.tahsins.daftarulang') }}
                    " > <i class="nav-icon fas fa-user-check"></i>
                    Daftar ulang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/tahsin/daftar-baru')) }} "
                    href="{{ route('admin.tahsins.daftarbaru') }}
                    " > <i class="nav-icon fas fa-user-plus"></i>
                    Daftar Baru
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/tahsin')) }} "
                    href="{{ route('admin.tahsins.index') }}
                    " > <i class="nav-icon fas fa-users"></i>
                    Peserta
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/tahsin/pembayaran')) }} "
                    href="{{ route('admin.tahsins.pembayaran') }}
                    " > <i class="nav-icon fas fa-credit-card"></i>
                    Pembayaran SPP
                    </a>
                </li>

            </ul>
        </nav>
    @elseif (auth()->user()->last_name === 'PENGAJAR' || auth()->user()->last_name === 'MUDIR')
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-title">
                    @lang('menus.backend.sidebar.general')
                </li>
                <li class="nav-item">
                    <a class="nav-link {{
                        active_class(Active::checkUriPattern('admin/dashboard'))
                    }}" href="{{ route('admin.dashboard') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        @lang('menus.backend.sidebar.dashboard')
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/amalans/*')) }} "
                    href="{{ route('admin.amalans.index') }}
                    " > <i class="nav-icon fas fa-edit"></i>
                    Amalan
                    </a>
                </li>

                <li class="nav-title">
                    RTQ
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/rtq')) }} "
                    href="{{ route('admin.rtqs.index') }}
                    " > <i class="nav-icon fas fa-users"></i>
                    Santri
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link "
                    href="#
                    " > <i class="nav-icon fas fa-edit"></i>
                    Nilai Pelajaran
                    </a>
                </li>
            </ul>
        </nav>
    @elseif (auth()->user()->last_name === 'Admin')
        @include('backend.includes.menu.admin')
    @endif
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
