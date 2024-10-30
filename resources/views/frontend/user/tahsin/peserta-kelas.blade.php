    @extends('frontend.user.layout-print')

    @section('user')
    @stack('before-styles')
        {{-- <link href="https://vitalets.github.io/x-editable/assets/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"> --}}
    @stack('after-styles')

    <div class="row" style="padding-bottom: 30px">
        <div class="col">
            <div class="text-center" style="font-size: 19px; font-weight: 600">
                Absensi Tahsin
            </div>
        </div><!--col-md-6-->
    </div><!--row-->
    <div class="row mb-4" style="font-size: 13px; font-weight: 500">
        <div class="col-md-6">
            <div class="row">
                <div class="col-4">Jenis Absen</div>
                <div class="col-8 info-absen">: {{ $jenis }}</div>
            </div>
            <div class="row">
                <div class="col-4">Angkatan</div>
                <div class="col-8 info-absen">: {{ $angkatan }}</div>
            </div>
            <div class="row">
                <div class="col-4">Periode</div>
                <div class="col-8 info-absen">: -</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-4">Pengajar</div>
                <div class="col-8 info-absen">: {{ $userpengajar }}</div>
            </div>
            <div class="row">
                <div class="col-4">Level</div>
                <div class="col-8 info-absen">: {{ $level }}</div>
            </div>
            <div class="row">
                <div class="col-4">Waktu</div>
                <div class="col-8 info-absen">: {{ $waktu }}</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center" style="font-weight: 600; padding-bottom: 20px ">
                    <div class="ab">
                        <table class="table table-sm table-bordered">
                            <thead >
                                <tr>
                                    <th style="vertical-align: middle;">
                                        Peserta
                                    </th>
                                    <th class="text-center">
                                        Absensi
                                    </th>
                                    @for ($i = 1; $i <= 15; $i++)
                                    <th class="text-center">
                                        {{ $i }}
                                    </th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $datapeserta as $peserta )
                                <tr>
                                    <td class="text-left">
                                        <span>
                                            <a href="https://wa.me/62{{ $peserta->nohp_peserta }}" style="color: rgb(56, 56, 56);" target="_blank">
                                                <div style="text-transform: uppercase;">{{ $peserta->nama_peserta }}</div>
                                                <div class="small text-muted">
                                                    {{ $peserta->no_tahsin }} | {{ $peserta->nohp_peserta }} 
                                                </div>
                                            </a>
                                            <!--<div class="small text-muted">-->
                                            <!--    {{ $peserta->no_tahsin }} | {{ $peserta->nohp_peserta }}-->
                                            <!--</div>-->
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        {{ $peserta->kenaikan_level_peserta }}
                                    </td>
                                    @for ($i = 1; $i <= 15; $i++)
                                        <td class="text-center">
                                            @php
                                                $dataabsen = $absen->where('id_peserta', $peserta->id )->where('pertemuan_ke_absen', $i)->where('angkatan_absen', $angkatan)->first()
                                            @endphp
                                            @if (empty($dataabsen->keterangan_absen))
                                                -
                                            @elseif ($dataabsen->keterangan_absen == 'HADIR')
                                                <i class="fas fa-check" style="font-size: 18px;color:dodgerblue"></i>
                                            @elseif ($dataabsen->keterangan_absen == 'TIDAK HADIR')
                                                <i class="fa-solid fa-circle-xmark" style="font-size: 18px;color:rgb(255, 30, 30)"></i>
                                            @elseif ($dataabsen->keterangan_absen != 'IZIN' || $dataabsen->keterangan_absen != 'SAKIT')
                                                <i class="fa-solid fa-circle-xmark" style="font-size: 18px;color:rgb(254, 171, 15)"></i>
                                            @else
                                                -
                                            @endif
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
    </div><!--row-->

    

    {{-- @livewire('absen-tahsin') --}}
    @stack('before-scripts')
    <script type="text/javascript">
        $(document).ready(function(){
              $("#ke").val("{!! $pertemuanke !!}");
        });
    </script>
    {{-- <script type="text/javascript">
        $( document ).ready(function() {
            $('#username').editable({
                type: 'text',
                pk: 1,
                url: '/post',
                title: 'Enter username'
            });
        });
    </script> --}}
    
    <script>
    $(document).ready(function(){
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    });
    </script>

    @stack('after-scripts')
    @endsection
