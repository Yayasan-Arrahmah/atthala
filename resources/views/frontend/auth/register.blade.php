@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.register_box_title'))

@section('content')
    <div class="row justify-content-center align-items-center" style="padding-top:100px">
        <div class="col col-sm-4 align-self-center">
            <div class="card">
                {{-- <div class="card-header">
                    <strong>
                        @lang('labels.frontend.auth.register_box_title')
                    </strong>
                </div><!--card-header--> --}}
                <center>
                    <img class="navbar-brand-full" src="{{ asset('img/logo.png') }}" width="150" alt="Honda" style="padding-top: 20px">
                </center>

                <div class="card-body">
                    {{ html()->form('POST', route('frontend.auth.register.post'))->open() }}
                    <input hidden="hidden" name="status" value="AKTIF">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    {{ html()->text('first_name')
                                        ->class('form-control')
                                        ->placeholder('Nama Lengkap')
                                        ->attribute('maxlength', 191)
                                        ->required()}}
                                </div><!--col-->
                            </div><!--row-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <select class="form-control" name="last_name" aria-placeholder="Status" required>
                                        <option value="PENGAJAR">Pengajar</option>
                                        <option value="KARYAWAN">Karyawan</option>
                                        <option value="SANTRI">Santri</option>
                                        <option value="WARGA">Warga</option>
                                    </select>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <select class="form-control" name="jenis" aria-placeholder="Status" required>
                                        <option value="IKHWAN">Ikhwan</option>
                                        <option value="AKHWAT">Akhwat</option>
                                    </select>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->email('email')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->password('password')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password'))
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->password('password_confirmation')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        @if(config('access.captcha.registration'))
                            <div class="row">
                                <div class="col">
                                    @captcha
                                    {{ html()->hidden('captcha_status', 'true') }}
                                </div><!--col-->
                            </div><!--row-->
                        @endif

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                    {{-- {{ form_submit(__('labels.frontend.auth.register_button')) }} --}}
                                    <button type="submit" class="btn btn-primary px-4 btn-block" style="background-color: rgb(83, 163, 28); border: rgb(83, 163, 28);">Daftar</button>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row" style="padding-top: 10px">
                            <div class="col">
                                <div class="text-left">
                                    <a href="{{ route('frontend.auth.login') }}" style="color: rgb(83, 163, 28);">
                                        <i class="fas fa-angle-double-left"></i> Login
                                    </a>
                                </div>
                            </div>
                        </div>
                    {{ html()->form()->close() }}

                    <div class="row">
                        <div class="col">
                            <div class="text-center">
                                {!! $socialiteLinks !!}
                            </div>
                        </div><!--/ .col -->
                    </div><!-- / .row -->

                </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col-md-8 -->
    </div><!-- row -->
@endsection

@push('after-scripts')
    @if(config('access.captcha.registration'))
        @captchaScripts
    @endif
@endpush
