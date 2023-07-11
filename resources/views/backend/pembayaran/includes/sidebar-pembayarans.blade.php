<li class="nav-item">
    <a class="nav-link {{ request()->is('admin/pembayarans*') ? 'active' : '' }}" href="{{ route('admin.pembayarans.index') }}">
        <i class="nav-icon icon-folder"></i> @lang('backend_pembayarans.sidebar.title')
    </a>
</li>
