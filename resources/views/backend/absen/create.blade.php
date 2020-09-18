@extends('backend.layouts.app')

@section('title', __('backend_absens.labels.management') . ' | ' . __('backend_absens.labels.create'))

@section('breadcrumb-links')
    @include('backend.absen.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.absens.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('backend_absens.labels.management')
                        <small class="text-muted">@lang('backend_absens.labels.create')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                    {{ html()->label(__('backend_absens.validation.attributes.id_peserta'))->class('col-md-2 form-control-label')->for('id_peserta') }}

                        <div class="col-md-10">
                            {{ html()->text('id_peserta')
                                ->class('form-control')
                                ->placeholder(__('backend_absens.validation.attributes.id_peserta'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.absens.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
