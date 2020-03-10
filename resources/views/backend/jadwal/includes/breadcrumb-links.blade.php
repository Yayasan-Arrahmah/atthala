<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('backend_jadwals.menus.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.jadwals.index') }}">@lang('backend_jadwals.menus.all')</a>
                <a class="dropdown-item" href="{{ route('admin.jadwals.create') }}">@lang('backend_jadwals.menus.create')</a>
                {{-- <a class="dropdown-item" href="{{ route('admin.jadwals.deactivated') }}">@lang('backed_jadwals.menus.deactivated')</a> --}}
                <a class="dropdown-item" href="{{ route('admin.jadwals.deleted') }}">@lang('backend_jadwals.menus.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
