<div class="row" style="padding-top: 10px">
    <div class="col">
        <div class="card" style="margin-bottom: .5rem;">
            <nav class=" navbar navbar-expand-lg navbar-light" style="padding: 0rem 1rem;">
                <a class="navbar-brand" href="{{ route('frontend.index') }}">
                    <img class="navbar-brand-full" src="{{ asset('img/logo.png') }}"height="55" alt="Ar-Rahmah Balikpapan">
                    {{-- <img class="navbar-brand-minimized" src="{{ asset('img/logo.png') }}" height="40" alt="Ar-Rahmah Balikpapan"> --}}
                </a>
                {{-- <div class="text-muted text-right float-right" style="font-size: 13px; font-weight: 500">
                    {{ $logged_in_user->email}}
                </div> --}}
                <button class="navbar-toggler navbar-toggler-right bg-light" style="color: #fff" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('labels.general.toggle_navigation')">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a href="{{route('frontend.user.dashboard')}}" class="nav-link {{ (request()->is(Route::is('frontend.user.dashboard'))) ? 'active' : '' }}"> <i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        @if (auth()->user()->last_name == 'PENGAJAR')
                            <li class="nav-item"><a href="{{route('frontend.user.absentahsin')}}" class="nav-link {{ (request()->is(Route::is('frontend.user.absen'))) ? 'active' : '' }}"> <i class="fas fa-list-alt"></i> Absen</a></li>
                        @endif
                        <li class="nav-item"><a href="{{route('frontend.user.amal-yaumiah')}}" class="nav-link {{ (request()->is(Route::is('frontend.user.amal-yaumiah'))) ? 'active' : '' }}"> <i class="fas fa-edit"></i> Amal Yaumiah</a></li>
                        <li class="nav-item"><a href="{{route('frontend.user.account')}}" class="nav-link {{ (request()->is(Route::is('frontend.user.account'))) ? 'active' : '' }}"> <i class="fas fa-user"></i> Akun, {{ $logged_in_user->email }}</a></li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuUser" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog"></i> Menu</a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuUser">
                                @can('view backend')
                                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">@lang('navs.frontend.user.administration')</a>
                                @endcan

                                <a href="{{ route('frontend.user.account') }}" class="dropdown-item {{ (request()->is(Route::is('frontend.user.account'))) ? 'active' : '' }}">@lang('navs.frontend.user.account')</a>
                                <a href="{{ route('frontend.auth.logout') }}" class="dropdown-item">@lang('navs.general.logout')</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
