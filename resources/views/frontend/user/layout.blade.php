@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
<div class="row mb-4" >
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    {{-- <div class="col-md-3 order-2 order-sm-1 mb-4 d-none d-md-block">
                        @include('frontend.user.dashboard.user-info')
                    </div><!--col-md-4-->

                    <div class="col-md-9 order-1 order-sm-2">
                        @yield('user')
                    </div>
                     --}}

                    <div class="col">
                        @yield('user')
                    </div>

                </div><!-- row -->
            </div> <!-- card-body -->
        </div><!-- card -->
    </div><!-- row -->
</div>

{{-- @stack('before-scripts')

<script type="text/javascript">
    $( document ).ready(function() {
    });
</script>
@stack('after-scripts') --}}
@endsection
