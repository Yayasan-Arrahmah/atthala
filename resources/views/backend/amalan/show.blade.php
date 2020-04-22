@extends('backend.layouts.app')

@section('title', __('backend_amalans.labels.management') . ' | ' . __('backend_amalans.labels.view'))

@section('breadcrumb-links')
    @include('backend.amalan.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ $amalan->nama_amalan }}
                    <br>
                    <small class="text-muted" style="font-size: 12px">{{ $amalan->deskripsi_amalan }}</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th width="50">No.</th>
                            <th>Nama Amalan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                        $amalan_lists = DB::table('amalans_lists')->where('id_amalan', '=', $amalan->id)->paginate(100);

                        $first  = 0;
                        $end    = 0;
                        $number = 1;
                        @endphp
                        @foreach($amalan_lists as $key=> $amalan_list)
                            <tr>
                                <td class="align-middle">{{  $key+ $amalan_lists->firstItem() }}</a></td>
                                <td class="align-middle">{{ $amalan_list->nama_amalan_list }}</td>
                            </tr>
                            @php
                            $first  = $amalan_lists->firstItem();
                            $end    = $key + $amalan_lists->firstItem();
                            @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>@lang('backend_amalans.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($amalan->created_at) }} ({{ $amalan->created_at->diffForHumans() }}),
                    <strong>@lang('backend_amalans.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($amalan->updated_at) }} ({{ $amalan->updated_at->diffForHumans() }})
                    @if($amalan->trashed())
                        <strong>@lang('backend_amalans.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($amalan->deleted_at) }} ({{ $amalan->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
