<li class="nav-item">
    <a class="nav-link {{ request()->is('admin/amalans*') ? 'active' : '' }}" href="{{ route('admin.amalans.index') }}">
        <i class="nav-icon icon-folder"></i> @lang('backend_amalans.sidebar.title')
    </a>
</li>
