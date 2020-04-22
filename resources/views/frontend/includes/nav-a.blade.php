<div class="row">
    <div class="col">
        <div class="card">
            <nav class=" navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="{{ route('frontend.index') }}">
                    <img class="navbar-brand-full" src="{{ asset('img/logo.png') }}"height="55" alt="Ar-Rahmah Balikpapan">
                    {{-- <img class="navbar-brand-minimized" src="{{ asset('img/logo.png') }}" height="40" alt="Ar-Rahmah Balikpapan"> --}}
                </a>

                <button class="navbar-toggler navbar-toggler-right bg-light" style="color: #fff" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('labels.general.toggle_navigation')">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a href="{{route('frontend.user.dashboard')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}"> <i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li class="nav-item"><a href="{{route('frontend.user.account')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.user.account')) }}"> <i class="fas fa-user"></i> Akun</a></li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuUser" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog"></i> Menu</a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuUser">
                                @can('view backend')
                                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">@lang('navs.frontend.user.administration')</a>
                                @endcan

                                <a href="{{ route('frontend.user.account') }}" class="dropdown-item {{ active_class(Active::checkRoute('frontend.user.account')) }}">@lang('navs.frontend.user.account')</a>
                                <a href="{{ route('frontend.auth.logout') }}" class="dropdown-item">@lang('navs.general.logout')</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
