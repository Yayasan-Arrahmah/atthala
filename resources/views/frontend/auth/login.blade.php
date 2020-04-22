@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
	<div class="row justify-content-center align-items-center" style="padding-top:100px">
		<div class="col col-sm-4 align-self-center">
			<div class="card">

                <center>
                    <img class="navbar-brand-full" src="{{ asset('img/logo.png') }}" width="150" alt="Honda" style="padding-top: 20px">
                </center>

				<div class="card-body">
					{{ html()->form('POST', route('frontend.auth.login.post'))->open() }}
						{{-- <p class="text-muted">Silahkan Login !</p> --}}
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="fas fa-user"></i>
								</span>
							</div>
							<input name="email" class="form-control" type="text" placeholder="Email">
						</div>
						<div class="input-group mb-4">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="fas fa-lock"></i>
								</span>
							</div>
							<input name="password" class="form-control" type="password" placeholder="Password">
						</div>
						<div class="row">
							<div class="col">
								<div class="form-group">
									<div class="checkbox">
										{{ html()->label(html()->checkbox('remember', true, 1) . ' ' . __('labels.frontend.auth.remember_me'))->for('remember') }}
									</div>
								</div><!--form-group-->
							</div><!--col-->
						</div><!--row-->
						<div class="row">
							<div class="col-6">
								<button type="submit" style="background-color: rgb(83, 163, 28);border: rgb(83, 163, 28);" class="btn btn-primary px-4" type="button">Login</button>
							</div>
							<div class="col-6 text-right">
                                <a style="color: rgb(83, 163, 28);" href="{{ route('frontend.auth.password.reset') }}">@lang('labels.frontend.passwords.forgot_password')</a>
                                <a href="{{ route('frontend.auth.register') }}" style="color: rgb(83, 163, 28);">
                                    Register <i class="fas fa-angle-double-right"></i>
                                </a>
							</div>
						</div>
					{{ html()->form()->close() }}


					<div class="row">
						<div class="col">
							<div class="text-center">

								{!! $socialiteLinks !!}
							</div>
						</div><!--col-->
					</div><!--row-->
				</div><!--card body-->
            </div><!--card-->
		</div><!-- col-md-8 -->
	</div><!-- row -->
@endsection
