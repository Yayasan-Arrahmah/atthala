<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('backend_absens.menus.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.absens.index') }}">@lang('backend_absens.menus.all')</a>
                <a class="dropdown-item" href="{{ route('admin.absens.create') }}">@lang('backend_absens.menus.create')</a>
                {{-- <a class="dropdown-item" href="{{ route('admin.absens.deactivated') }}">@lang('backed_absens.menus.deactivated')</a> --}}
                <a class="dropdown-item" href="{{ route('admin.absens.deleted') }}">@lang('backend_absens.menus.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
