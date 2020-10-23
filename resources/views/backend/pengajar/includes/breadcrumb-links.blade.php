<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('backend_pengajars.menus.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.pengajars.index') }}">@lang('backend_pengajars.menus.all')</a>
                <a class="dropdown-item" href="{{ route('admin.pengajars.create') }}">@lang('backend_pengajars.menus.create')</a>
                {{-- <a class="dropdown-item" href="{{ route('admin.pengajars.deactivated') }}">@lang('backed_pengajars.menus.deactivated')</a> --}}
                <a class="dropdown-item" href="{{ route('admin.pengajars.deleted') }}">@lang('backend_pengajars.menus.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
