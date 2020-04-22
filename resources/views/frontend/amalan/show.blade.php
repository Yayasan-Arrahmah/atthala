@extends('frontend.layouts.app')

@section('title', __('frontend_amalans.labels.management') . ' | ' . __('frontend_amalans.labels.view'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('frontend_amalans.labels.management')
                    <small class="text-muted">@lang('frontend_amalans.labels.view')</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i> @lang('frontend_amalans.labels.title')</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">

                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr>
                                        <th>@lang('frontend_amalans.labels.title')</th>
                                        <td>{{ $amalan->title }}</td>
                                    </tr>
                                </table>
                            </div><!--table-responsive-->
                        </div><!--col-->

                    </div><!--tab-->
                </div><!--tab-content-->
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>@lang('frontend_amalans.labels.created_at'):</strong> {{ timezone()->convertToLocal($amalan->created_at) }} ({{ $amalan->created_at->diffForHumans() }}),
                    <strong>@lang('frontend_amalans.labels.last_updated'):</strong> {{ timezone()->convertToLocal($amalan->updated_at) }} ({{ $amalan->updated_at->diffForHumans() }})
                    @if($amalan->trashed())
                        <strong>@lang('frontend_amalans.labels.deleted_at'):</strong> {{ timezone()->convertToLocal($amalan->deleted_at) }} ({{ $amalan->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
