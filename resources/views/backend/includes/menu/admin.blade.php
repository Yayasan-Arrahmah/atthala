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
                Dashboard Tahsin
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
            <a class="nav-link"
            href="#
            " > <i class="nav-icon fas fa-edit"></i>
            Nilai Pelajaran
            </a>
        </li>

        <li class="nav-title">
            Tahsin
        </li>
        <li class="nav-item nav-dropdown {{-- ADMINISTRASI --}}
            {{ (request()->is('admin/tahsin/dashboard')) ? 'open' : '' }}
            {{ (request()->is('admin/tahsin/peserta')) ? 'open' : '' }}
            {{ (request()->is('admin/tahsin/peserta/baru')) ? 'open' : '' }}
            {{ (request()->is('admin/tahsin/peserta/aktif')) ? 'open' : '' }}
            {{ (request()->is('admin/tahsin/peserta/daftar-ujian')) ? 'open' : '' }}
            {{ (request()->is('admin/tahsin/peserta/daftar-ulang')) ? 'open' : '' }}
            {{ (request()->is('admin/tahsin/peserta/cuti')) ? 'open' : '' }}
            {{ (request()->is('admin/tahsin/peserta/off')) ? 'open' : '' }}
            ">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fas fa-book-open"></i>
                Administrasi
            </a>
            <ul class="nav-dropdown-items">
                {{-- <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tahsin/peserta/dashboard')) ? 'active' : '' }}" href="/admin/tahsin/peserta/dashboard">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Dashboard
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tahsin/peserta/daftar-ulang')) ? 'active' : '' }}" href="/admin/tahsin/peserta/daftar-ulang">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Peserta Daftar Ulang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tahsin/peserta/baru')) ? 'active' : '' }}" href="/admin/tahsin/peserta/baru">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Peserta Baru
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tahsin/peserta/aktif')) ? 'active' : '' }}" href="/admin/tahsin/peserta/aktif">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Peserta Aktif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tahsin/peserta/daftar-ujian')) ? 'active' : '' }}" href="/admin/tahsin/peserta/daftar-ujian">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Peserta Ujian
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tahsin/peserta/cuti')) ? 'active' : '' }}" href="/admin/tahsin/peserta/cuti">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Peserta Cuti
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tahsin/peserta/off')) ? 'active' : '' }}" href="/admin/tahsin/peserta/off">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Peserta OFF
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tahsin/peserta')) ? 'active' : '' }}" href="/admin/tahsin/peserta">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Peserta
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item nav-dropdown {{-- PENGAJAR --}}
            {{ (request()->is('admin/tahsin/daftar-baru')) ? 'open' : '' }}
            {{ (request()->is('admin/tahsin/peserta/a')) ? 'open' : '' }}
            ">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fas fa-users"></i>
                Pengajar
            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tahsin/daftar-baru')) ? 'active' : '' }}" href="#">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Data Pengajar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tahsin/peserta/a')) ? 'active' : '' }}" href="#">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Absensi Pengajar o
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item nav-dropdown {{-- JADWAL --}}
            {{ (request()->is('admin/tahsin/daftar-baru')) ? 'open' : '' }}
            {{ (request()->is('admin/tahsin/daftar-baru')) ? 'open' : '' }}
            {{ (request()->is('admin/tahsin/peserta/a')) ? 'open' : '' }}
            {{ (request()->is('admin/tahsin/peserta-ujian')) ? 'open' : '' }}
            ">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fas fa-list"></i>
                Jadwal
            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tahsin/daftar-baru')) ? 'active' : '' }}" href="#">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Data Jadwal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tahsin/daftar-baru')) ? 'active' : '' }}" href="#">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Status Jadwal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tahsin/peserta/a')) ? 'active' : '' }}" href="#">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Absensi Per-Jadwal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tahsin/peserta-ujian')) ? 'active' : '' }}" href="#">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Kalender Jadwal
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item nav-dropdown {{-- PEMBAYARAN --}}
            {{ (request()->is('admin/tahsin/pembayaran/daftar-ulang')) ? 'open' : '' }}
            {{ (request()->is('admin/tahsin/pembayaran/daftar-baru')) ? 'open' : '' }}
            {{ (request()->is('admin/tahsin/pembayaran/daftar-ujian')) ? 'open' : '' }}
            {{ (request()->is('admin/tahsin/pembayaran/spp')) ? 'open' : '' }}
            ">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fas fa-credit-card"></i>
                Pembayaran
            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tahsin/pembayaran/daftar-ulang')) ? 'active' : '' }}" href="/admin/tahsin/pembayaran/daftar-ulang">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Daftar Ulang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tahsin/pembayaran/daftar-baru')) ? 'active' : '' }}" href="/admin/tahsin/pembayaran/daftar-baru">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Daftar Baru
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tahsin/pembayaran/daftar-ujian')) ? 'active' : '' }}" href="/admin/tahsin/pembayaran/daftar-ujian">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Daftar Ujian
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tahsin/pembayaran/spp')) ? 'active' : '' }}" href="/admin/tahsin/pembayaran/spp">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> SPP
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tahsin/pembayaran/rekapitulasi')) ? 'active' : '' }}" href="/admin/tahsin/pembayaran/rekapitulasi">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Rekapitulasi
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/tahsin/pengaturan')) }} "
            href="{{ route('admin.tahsins.pengaturan') }}
            " > <i class="nav-icon fas fa-cog"></i>
            Pengaturan
            </a>
        </li>

        {{-- #################### --}}

        {{-- <li class="nav-title">
            TLA
        </li>
        <li class="nav-item nav-dropdown <!- ADMINISTRASI -->
            {{ (request()->is('admin/tla/daftar-baru')) ? 'open' : '' }}
            {{ (request()->is('admin/tla/peserta')) ? 'open' : '' }}
            {{ (request()->is('admin/tla/peserta-ujian')) ? 'open' : '' }}
            {{ (request()->is('admin/tla/daftar-ulang')) ? 'open' : '' }}
            {{ (request()->is('admin/tla/peserta-cuti')) ? 'open' : '' }}
            {{ (request()->is('admin/tla/peserta-off')) ? 'open' : '' }}
            ">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fas fa-book-open"></i>
                Administrasi
            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tla/daftar-ulang')) ? 'active' : '' }}" href="/admin/tla/daftar-ulang">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Peserta Daftar Ulang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tla/daftar-baru')) ? 'active' : '' }}" href="/admin/tla/daftar-baru">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Peserta Baru
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tla/peserta')) ? 'active' : '' }}" href="/admin/tla/peserta">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Peserta Aktif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tla/peserta-ujian')) ? 'active' : '' }}" href="/admin/tla/peserta-ujian">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Peserta Ujian
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tla/peserta-cuti')) ? 'active' : '' }}" href="/admin/tla/peserta-cuti">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Peserta Cuti
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tla/peserta-off')) ? 'active' : '' }}" href="/admin/tla/peserta-off">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Peserta OFF
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item nav-dropdown <!- PENGAJAR -->
            {{ (request()->is('admin/tla/daftar-baru')) ? 'open' : '' }}
            {{ (request()->is('admin/tla/peserta-')) ? 'open' : '' }}
            ">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fas fa-users"></i>
                Pengajar
            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tla/daftar-baru')) ? 'active' : '' }}" href="/admin/tla/daftar-baru">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Data Pengajar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tla/peserta-')) ? 'active' : '' }}" href="/admin/tla/peserta">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Absensi Pengajar
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item nav-dropdown <!- JADWAL -->
            {{ (request()->is('admin/tla/daftar-baru')) ? 'open' : '' }}
            {{ (request()->is('admin/tla/daftar-baru')) ? 'open' : '' }}
            {{ (request()->is('admin/tla/peserta-')) ? 'open' : '' }}
            {{ (request()->is('admin/tla/peserta-ujian')) ? 'open' : '' }}
            ">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fas fa-list"></i>
                Jadwal
            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tla/daftar-baru')) ? 'active' : '' }}" href="/admin/tla/daftar-baru">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Data Jadwal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tla/daftar-baru')) ? 'active' : '' }}" href="/admin/tla/daftar-baru">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Status Jadwal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tla/peserta')) ? 'active' : '' }}" href="/admin/tla/peserta">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Absensi Per-Jadwal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tla/peserta-ujian')) ? 'active' : '' }}" href="/admin/tla/peserta-ujian">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Kalender Jadwal
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item nav-dropdown <!- PEMBAYARAN -->
            {{ (request()->is('admin/tla/daftar-baru')) ? 'open' : '' }}
            {{ (request()->is('admin/tla/peserta')) ? 'open' : '' }}
            {{ (request()->is('admin/tla/peserta-ujian')) ? 'open' : '' }}
            {{ (request()->is('admin/tla/daftar-ulang')) ? 'open' : '' }}
            {{ (request()->is('admin/tla/peserta-cuti')) ? 'open' : '' }}
            {{ (request()->is('admin/tla/peserta-off')) ? 'open' : '' }}
            ">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fas fa-credit-card"></i>
                Pembayaran
            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tla/daftar-ulang')) ? 'active' : '' }}" href="/admin/tla/daftar-ulang">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Daftar Ulang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tla/daftar-baru')) ? 'active' : '' }}" href="/admin/tla/daftar-baru">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Daftar Baru
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tla/peserta-ujian')) ? 'active' : '' }}" href="/admin/tla/peserta-ujian">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> Daftar Ujian
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/tla/peserta-cuti')) ? 'active' : '' }}" href="/admin/tla/peserta-cuti">
                        <i class="fas fa-caret-right pr-2 pl-2"></i> SPP
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/tahsin/pengaturan')) }} "
            href="{{ route('admin.tahsins.pengaturan') }}
            " > <i class="nav-icon fas fa-cog"></i>
            Pengaturan
            </a>
        </li> --}}


        <li class="nav-title">
            @lang('menus.backend.sidebar.system')
        </li>

        @if ($logged_in_user->isAdmin())

            <li class="nav-item nav-dropdown {{
                active_class(Active::checkUriPattern('admin/auth*'), 'open')
            }}">
                <a class="nav-link nav-dropdown-toggle {{
                    active_class(Active::checkUriPattern('admin/auth*'))
                }}" href="#">
                    <i class="nav-icon far fa-user"></i>
                    @lang('menus.backend.access.title')

                    @if ($pending_approval > 0)
                        <span class="badge badge-danger">{{ $pending_approval }}</span>
                    @endif
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/auth/user*'))
                        }}" href="{{ route('admin.auth.user.index') }}">
                            @lang('labels.backend.access.users.management')

                            @if ($pending_approval > 0)
                                <span class="badge badge-danger">{{ $pending_approval }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Active::checkUriPattern('admin/auth/role*'))
                        }}" href="{{ route('admin.auth.role.index') }}">
                            @lang('labels.backend.access.roles.management')
                        </a>
                    </li>
                </ul>
            </li>

            <li class="divider"></li>

            <li class="nav-item nav-dropdown {{
                active_class(Active::checkUriPattern('admin/log-viewer*'), 'open')
            }}">
                    <a class="nav-link nav-dropdown-toggle {{
                        active_class(Active::checkUriPattern('admin/log-viewer*'))
                    }}" href="#">
                    <i class="nav-icon fas fa-list"></i> @lang('menus.backend.log-viewer.main')
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{
                        active_class(Active::checkUriPattern('admin/log-viewer'))
                    }}" href="{{ route('log-viewer::dashboard') }}">
                            @lang('menus.backend.log-viewer.dashboard')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{
                        active_class(Active::checkUriPattern('admin/log-viewer/logs*'))
                    }}" href="{{ route('log-viewer::logs.list') }}">
                            @lang('menus.backend.log-viewer.logs')
                        </a>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
</nav>
