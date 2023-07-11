<li class="nav-item">
    <a class="nav-link {{ request()->is('admin/rtqs*') ? 'active' : '' }}" href="{{ route('admin.rtqs.index') }}">
        <i class="nav-icon icon-folder"></i> @lang('backend_rtqs.sidebar.title')
    </a>
</li>
