<li class="nav-item">
    <a class="nav-link {{ request()->is('admin/absens*') ? 'active' : '' }}" href="{{ route('admin.absens.index') }}">
        <i class="nav-icon icon-folder"></i> @lang('backend_absens.sidebar.title')
    </a>
</li>
