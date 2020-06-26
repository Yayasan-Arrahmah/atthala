@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.users.management'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.users.management') }} <small class="text-muted">{{ __('labels.backend.access.users.active') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.auth.user.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <form class="row mt-4" action="{{ route('admin.auth.user.index') }}" method="get">
            @csrf
            <div class="col-md-1">
                <select id="selectpaged" class="form-control" name="paged">
                    <option>{{ request()->input('paged') ?? $paged }}</option>
                    <option>---</option>
                    <option>5</option>
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                    <option>150</option>
                </select>
            </div>

            <div class="col-md-2 text-center">
            </div>
            <div class="col-md-2 text-center">
                <select class="form-control" name="status" onchange='this.form.submit()'>
                    <option value="">{{ request()->input('status') ?? 'Pilih Status' }}</option>
                    <option>---</option>
                    <option value="">Semua</option>
                    <option value="KARYAWAN">Karyawan</option>
                    <option value="PENGAJAR">Pengajar</option>
                    <option value="SANTRI">Santir</option>
                </select>
            </div>
            <div class="col-md-2 text-center">
                <select class="form-control" name="jenis" onchange='this.form.submit()'>
                    <option value="">{{ request()->input('jenis') ?? 'Pilih Jenis' }}</option>
                    <option>---</option>
                    <option value="">Semua</option>
                    <option value="IKHWAN">Ikhwan</option>
                    <option value="AKHWAT">Akhwat</option>
                </select>
            </div>
            <div class="col-md-4 pull-right">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input class="form-control" type="text" name="cari" placeholder="Cari Nama Atau Email" autocomplete="password" width="100" value="{{ request()->input('cari') ?? '' }}">
                </div>
            </div>
            <div class="col-md-1 text-center" style="padding-left: 0px">
                <button class="btn btn-primary btn-block"><i class="fa fa-search"></i> Cari</button>
            </div>
        </form>
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive-sm table-hover mb-0 table-sm">
                    <table class="table display compact nowarp" style="width:100%">
                        <thead>
                        <tr>
                            <th>@lang('Status')</th>
                            <th>@lang('labels.backend.access.users.table.first_name')</th>
                            <th>Jenis</th>
                            <th>@lang('labels.backend.access.users.table.email')</th>
                            <th>@lang('labels.backend.access.users.table.confirmed')</th>
                            <th>@lang('labels.backend.access.users.table.roles')</th>
                            <th>@lang('labels.backend.access.users.table.other_permissions')</th>
                            {{-- <th>@lang('labels.backend.access.users.table.social')</th> --}}
                            {{-- <th>@lang('labels.backend.access.users.table.last_updated')</th> --}}
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $first  = 0;
                            $end    = 0;
                        @endphp
                        @foreach($users as $key => $user)
                        @php
                            $key+ $users->firstItem();
                        @endphp
                            <tr>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->jenis }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{!! $user->confirmed_label !!}</td>
                                <td>{!! $user->roles_label !!}</td>
                                <td>{!! $user->permissions_label !!}</td>
                                {{-- <td>{!! $user->social_buttons !!}</td> --}}
                                {{-- <td>{{ $user->updated_at->diffForHumans() }}</td> --}}
                                <td>{!! $user->action_buttons !!}</td>
                            </tr>
                            @php
                                $first  = $users->firstItem();
                                $end    = $key + $users->firstItem();
                            @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $first !!} - {!! $end !!} From {!! $users->total() !!} Data
                    {{-- {!! $users->total() !!} {{ trans_choice('labels.backend.access.users.table.total', $users->total()) }} --}}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $users->appends(request()->query())->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->

@stack('before-scripts')

<script type="text/javascript">
    $(document).ready(function() {
        var select = document.getElementById('selectpaged');
        select.addEventListener('change', function(){
            this.form.submit();
        }, false);
    });
</script>

@stack('after-scripts')

@endsection
