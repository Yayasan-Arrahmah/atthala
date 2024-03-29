<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th>Foto Profil</th>
            <td><img src="{{ $logged_in_user->picture }}" class="user-profile-image" /></td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.name')</th>
            <td>{{ $logged_in_user->first_name }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $logged_in_user->last_name }}</td>
        </tr>
        <tr>
            <th>Jenis</th>
            <td>{{ $logged_in_user->jenis }}</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.email')</th>
            <td>{{ $logged_in_user->email }}</td>
        </tr>
        {{-- <tr>
            <th>@lang('labels.frontend.user.profile.created_at')</th>
            <td>{{ timezone()->convertToLocal($logged_in_user->created_at) }} ({{ $logged_in_user->created_at->diffForHumans() }})</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.last_updated')</th>
            <td>{{ timezone()->convertToLocal($logged_in_user->updated_at) }} ({{ $logged_in_user->updated_at->diffForHumans() }})</td>
        </tr> --}}
    </table>
</div>
