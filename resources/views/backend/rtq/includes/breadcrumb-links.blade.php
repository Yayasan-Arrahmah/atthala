<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('backend_rtqs.menus.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.rtqs.index') }}">@lang('backend_rtqs.menus.all')</a>
                <a class="dropdown-item" href="{{ route('admin.rtqs.create') }}">@lang('backend_rtqs.menus.create')</a>
                {{-- <a class="dropdown-item" href="{{ route('admin.rtqs.deactivated') }}">@lang('backed_rtqs.menus.deactivated')</a> --}}
                <a class="dropdown-item" href="{{ route('admin.rtqs.deleted') }}">@lang('backend_rtqs.menus.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
