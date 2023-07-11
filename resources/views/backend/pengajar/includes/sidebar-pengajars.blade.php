<li class="nav-item">
    <a class="nav-link {{ request()->is('admin/pengajars*') ? 'active' : '' }}" href="{{ route('admin.pengajars.index') }}">
        <i class="nav-icon icon-folder"></i> @lang('backend_pengajars.sidebar.title')
    </a>
</li>
