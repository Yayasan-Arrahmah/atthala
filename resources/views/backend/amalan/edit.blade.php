@extends('backend.layouts.app')

@section('title', __('backend_amalans.labels.management') . ' | ' . __('backend_amalans.labels.edit'))

@section('breadcrumb-links')
    @include('backend.amalan.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($amalan, 'PATCH', route('admin.amalans.update', $amalan->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('backend_amalans.labels.management')
                        <small class="text-muted">@lang('backend_amalans.labels.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                    {{ html()->label('Nama Amalan')->class('col-md-2 form-control-label')->for('title') }}

                        <div class="col-md-10">
                            {{ html()->text('nama_amalan')
                                ->class('form-control')
                                ->placeholder('Nama Amalan')
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                        {{ html()->label('Deskripsi Amalan')->class('col-md-2 form-control-label')->for('title') }}

                            <div class="col-md-10">
                                {{ html()->text('deskripsi_amalan')
                                    ->class('form-control')
                                    ->placeholder('Deskripsi Amalan')
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
                    {{ form_cancel(route('admin.amalans.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
