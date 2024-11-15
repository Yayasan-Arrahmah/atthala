@extends('backend.layouts.app-2')

@section('title', app_name() . '| Tahsin Absensi')

@section('content')
<style>
    /* table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    } */
    div.dt-buttons {
        float: none !important;
    }

</style>
<script src="
https://cdn.jsdelivr.net/npm/datatables@1.10.18/media/js/jquery.dataTables.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/datatables@1.10.18/media/css/jquery.dataTables.min.css
" rel="stylesheet">
<script src="
https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js
"></script>
<script src="
https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js
"></script>
<script src="
https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js
"></script>
<script src="
https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js
"></script>
<script src="
https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js
"></script>
<script src="
//cdn.datatables.net/plug-ins/1.13.6/api/sum().js
"></script>
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css
" rel="stylesheet">
<script>
    $(document).ready( function () {
    $('#rekap').DataTable({
        "autoWidth": true,
        "scrollX": true,
        // "order": [[ 1, "asc" ]],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                text: 'Download Data Excel',
                title: 'Laporan Kehadiran Pengajar Tahsin Angkatan {!! request()->angkatan ?? 25 !!}',
            }
        ],
    });
} );
</script>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="m-0">
                    Laporan Kehadiran Pengajar Tahsin Angkatan {!! request()->angkatan ?? 25 !!}
                    {{-- - <u>{{ $title ?? 'Jadwal' }}</u> --}}
                </h4>
            </div><!--card-header-->
            <div class="card-body">
                {{-- @include('backend.pendidikan.tahsin.component.filter-jadwal') --}}
            </div><!--card-body-->
        </div><!--card-->
    </div><!--col-->
</div><!--row-->

<div class="row ">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <table class="table table-lg table-striped display nowrap" id="rekap" width="100%">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">Pengajar</th>
                            @for ($i = 1; $i <= 16; $i++)
                                <th class="border border-gray-300 px-4 py-2">Pertemuan {{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwals as $jadwal)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $jadwal->pengajar_jadwal }}</td>
                                @for ($i = 1; $i <= 16; $i++)
                                    @php
                                        $pertemuan = $jadwal->absenPertemuan->firstWhere('pertemuan', $i);
                                    @endphp
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $pertemuan ? $pertemuan->tanggal_pertemuan : '-' }}
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@push('scripts')
{{-- {{$dataTable->scripts()}} --}}
@endpush

@endsection
