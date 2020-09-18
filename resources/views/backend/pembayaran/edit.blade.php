@extends('backend.layouts.app')

@section('title', __('backend_pembayarans.labels.management') . ' | ' . __('backend_pembayarans.labels.edit'))

@section('breadcrumb-links')
    @include('backend.pembayaran.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($pembayaran, 'PATCH', route('admin.pembayarans.update', $pembayaran->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('backend_pembayarans.labels.management')
                        <small class="text-muted">@lang('backend_pembayarans.labels.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                    {{ html()->label(__('backend_pembayarans.validation.attributes.uuid_pembayaran'))->class('col-md-2 form-control-label')->for('uuid_pembayaran') }}

                        <div class="col-md-10">
                            {{ html()->text('uuid_pembayaran')
                                ->class('form-control')
                                ->placeholder(__('backend_pembayarans.validation.attributes.uuid_pembayaran'))
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
                    {{ form_cancel(route('admin.pembayarans.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
