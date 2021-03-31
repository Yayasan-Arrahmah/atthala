<div class="sidebar">
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
            {{-- <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/rtq/rapor/')) }} "
                href="{{ route('admin.rtqs.rapor') }}
                " > <i class="nav-icon fas fa-users"></i>
                Rapor
                </a>
            </li> --}}
            @if ( auth()->user()->last_name == 'Admin' )

                <li class="nav-title">
                    Tahsin
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/tahsin/upload')) }} "
                    href="{{ route('admin.tahsins.upload') }}
                    " > <i class="nav-icon fas fa-upload"></i>
                    Upload
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
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/tahsin/absen*')) }} "
                    href="{{ route('admin.tahsins.absen') }}
                    " > <i class="nav-icon fas fa-edit"></i>
                    Absen
                    </a>
                </li>
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/tahsin/absen*'), 'open') }} {{ active_class(Active::checkUriPattern('admin/absen*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/tahsin/absen*')) }} {{ active_class(Active::checkUriPattern('admin/absen*')) }}" href="#">
                        <i class="nav-icon fas fa-edit"></i>
                        Absen
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/absen')) }}" href="{{ route('admin.tahsins.absen') }}">
                                Pengajar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/tahsin/absen*')) }}" href="{{ route('admin.tahsins.absen') }}">
                                Kelas
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/tahsin/jadwal*')) }} "
                    href="{{ route('admin.tahsins.jadwal') }}
                    " > <i class="nav-icon fas fa-list-alt"></i>
                    Jadwal
                    </a>
                </li> --}}
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/tahsin/jadwal*'), 'open') }} {{ active_class(Active::checkUriPattern('admin/jadwal*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/tahsin/jadwal*')) }} {{ active_class(Active::checkUriPattern('admin/jadwal*')) }}" href="#">
                        <i class="nav-icon fas fa-list-alt"></i>
                        Jadwal
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/jadwal')) }}" href="{{ route('admin.jadwals.index') }}">
                                Data Jadwal
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/tahsin/jadwal*')) }}" href="{{ route('admin.tahsins.jadwal') }}">
                                Status Jadwal
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/tahsin/pengajar')) }} "
                    href="{{ route('admin.tahsins.pengajar') }}
                    " > <i class="nav-icon fas fa-user-md"></i>
                    Pengajar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/tahsin/pembayaran')) }} "
                    href="{{ route('admin.tahsins.pembayaran') }}
                    " > <i class="nav-icon fas fa-credit-card"></i>
                    Pembayaran
                    </a>
                </li>
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/tahsin/ujian*'), 'open') }} {{ active_class(Active::checkUriPattern('admin/tahsin/peserta-ujian*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/tahsin/ujian*')) }} {{ active_class(Active::checkUriPattern('admin/tahsin/peserta-ujian*'), 'open') }}" href="#">
                        <i class="nav-icon fas fa-check"></i>
                        Ujian
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/tahsin/ujian')) }}" href="{{ route('admin.tahsins.ujian') }}">
                                Peserta
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/tahsin/peserta-ujian*')) }}" href="{{ route('admin.tahsins.pesertaujian') }}">
                            Daftar Ulang
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
            @endif
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
