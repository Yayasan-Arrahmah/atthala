<div class="card mb-4">
    {{-- <img class="card-img-top" src="{{ $logged_in_user->picture }}" alt="Profile Picture"> --}}
    <div style="text-align: center; padding-top: 15px">
        <img class="card-img-top" src="{{ $logged_in_user->picture }}" alt="Profile Picture"
        style="
        object-fit: cover;
        height: 120px;
        width: 120px;
        border-radius: 50%;
        ">
    </div>

    <div class="card-body">
        <h4 class="card-title">
            {{ $logged_in_user->first_name }}<br/>
        </h4>

        <p class="card-text">
            <small>
                <i class="fas fa-envelope"></i> {{ $logged_in_user->email }}<br/>
                <i class="fas fa-suitcase"></i> {{ ucwords(strtolower($logged_in_user->last_name)) }}<br/>
                <i class="fas fa-user"></i> {{ ucwords(strtolower($logged_in_user->jenis)) }}<br/>
                <i class="fas fa-check"></i> {{ ucwords(strtolower($logged_in_user->status)) }}<br/>
                <i class="fas fa-calendar-check"></i> @lang('strings.frontend.general.joined') {{ timezone()->convertToLocal($logged_in_user->created_at, 'F jS, Y') }}
            </small>
        </p>

        <p class="card-text">

            <a href="{{ route('frontend.user.account')}}" class="btn btn-info btn-sm mb-1">
                <i class="fas fa-user-circle"></i> @lang('navs.frontend.user.account')
            </a>

            @can('view backend')
            &nbsp;<a href="{{ route('admin.dashboard')}}" class="btn btn-danger btn-sm mb-1">
                <i class="fas fa-user-secret"></i> @lang('navs.frontend.user.administration')
            </a>
            @endcan
        </p>
    </div>
</div>
