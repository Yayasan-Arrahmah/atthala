<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('backend_amalans.menus.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.amalans.index') }}">@lang('backend_amalans.menus.all')</a>
                <a class="dropdown-item" href="{{ route('admin.amalans.create') }}">@lang('backend_amalans.menus.create')</a>
                {{-- <a class="dropdown-item" href="{{ route('admin.amalans.deactivated') }}">@lang('backed_amalans.menus.deactivated')</a> --}}
                <a class="dropdown-item" href="{{ route('admin.amalans.deleted') }}">@lang('backend_amalans.menus.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
