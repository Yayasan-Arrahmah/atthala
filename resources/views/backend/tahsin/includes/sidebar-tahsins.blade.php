<li class="nav-item">
    <a class="nav-link {{ request()->is('admin/tahsins*') ? 'active' : '' }}" href="{{ route('admin.tahsins.index') }}">
        <i class="nav-icon icon-folder"></i> @lang('backend_tahsins.sidebar.title')
    </a>
</li>
