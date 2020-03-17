<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('backend_tahsins.menus.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.tahsins.index') }}">@lang('backend_tahsins.menus.all')</a>
                <a class="dropdown-item" href="{{ route('admin.tahsins.create') }}">@lang('backend_tahsins.menus.create')</a>
                {{-- <a class="dropdown-item" href="{{ route('admin.tahsins.deactivated') }}">@lang('backed_tahsins.menus.deactivated')</a> --}}
                <a class="dropdown-item" href="{{ route('admin.tahsins.deleted') }}">@lang('backend_tahsins.menus.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
