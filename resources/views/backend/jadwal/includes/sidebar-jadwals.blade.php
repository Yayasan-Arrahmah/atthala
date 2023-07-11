<li class="nav-item">
    <a class="nav-link {{ request()->is('admin/jadwals*') ? 'active' : '' }}" href="{{ route('admin.jadwals.index') }}">
        <i class="nav-icon icon-folder"></i> @lang('backend_jadwals.sidebar.title')
    </a>
</li>
