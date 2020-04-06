<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('backend_pembayarans.menus.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.pembayarans.index') }}">@lang('backend_pembayarans.menus.all')</a>
                <a class="dropdown-item" href="{{ route('admin.pembayarans.create') }}">@lang('backend_pembayarans.menus.create')</a>
                {{-- <a class="dropdown-item" href="{{ route('admin.pembayarans.deactivated') }}">@lang('backed_pembayarans.menus.deactivated')</a> --}}
                <a class="dropdown-item" href="{{ route('admin.pembayarans.deleted') }}">@lang('backend_pembayarans.menus.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
