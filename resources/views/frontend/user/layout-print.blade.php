@extends('frontend.layouts.app-print')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
<div class="row mb-4" >
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">

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
