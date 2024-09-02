@extends('backend.layouts.app-2')

@section('title', app_name() . '| Tahsin Jadwal')

@section('content')

<!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="tambahdata" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="{{ route('admin.tahsin/jadwal.postCreateJadwal') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahdata">Tambah Data Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label lass="form-label">Pengajar <span style="color:red !important">*</span></label>
                        <select name="pengajar" name="pengajar" class="form-control" required>
                            <option value="">Pilih Pengajar...</option>
                            @foreach($datapengajars as $pengajar)
                                <option value="{{ $pengajar->nama_pengajar }}">{{ $pengajar->nama_pengajar }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label lass="form-label">Level <span style="color:red !important">*</span></label>
                        <select name="level" class="form-control" required>
                            <option value="">Pilih Level...</option>
                            @foreach ( $datalevel as $level )
                                <option value="{{ $level->nama }}">{{ $level->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label lass="form-label">
                            Waktu <span style="color:red !important">*</span>
                        </label>
                        <div class="row">
                            <div class="col-sm-6 pr-0">
                                <select name="hari" class="form-control" id="hari" required>
                                    <option value="">Hari...</option>
                                    <option value="AHAD">AHAD</option>
                                    <option value="SENIN">SENIN</option>
                                    <option value="SELASA">SELASA</option>
                                    <option value="RABU">RABU</option>
                                    <option value="KAMIS">KAMIS</option>
                                    <option value="JUMAT">JUMAT</option>
                                    <option value="SABTU">SABTU</option>
                                </select>
                            </div>
                            <div class="col-sm-6 pl-0">
                                <select name="jam" class="form-control" required>
                                    <option value="">Jam...</option>
                                    @for ($i = 5; $i <= 22; $i++)
                                        @php
                                            $jam_ = ($i < 10 ? '0'.$i : $i).':00';
                                        @endphp
                                        <option value="{{ $jam_ }}">{{ $jam_ }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label lass="form-label">Jenis <span style="color:red !important">*</span></label>
                        <select name="jenis" class="form-control" required>
                            <option value="IKHWAN">IKHWAN</option>
                            <option value="AKHWAT">AKHWAT</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label lass="form-label">Jumlah Batasan Peserta <span style="color:red !important">*</span></label>
                        <input name="jumlahpeserta" class="form-control" type="number" value="0" required>
                    </div>
                    <div class="mb-3">
                        <label lass="form-label">Status Belajar <span style="color:red !important">*</span></label>
                        <select name="statusbelajar" class="form-control" required>
                            <option value="ONLINE / OFFLINE">ONLINE / OFFLINE</option>
                            <option value="ONLINE">ONLINE</option>
                            <option value="OFFLINE">OFFLINE</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label lass="form-label">Angkatan <span style="color:red !important">*</span></label>
                        <select name="angkatan" class="form-control" required>
                            @for ($i = 24; $i >= 16; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
  </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">
                        Jadwal Tahsin
                        {{-- - <u>{{ $title ?? 'Jadwal' }}</u> --}}
                    </h4>
                </div><!--card-header-->
                <div class="card-body">
                    @include('backend.pendidikan.tahsin.component.filter-jadwal')
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tabelabsen').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });

    </script>
    <div class="row ">
        <div class="col">
            <div class="card">
                <div class="card-body">
                        @php
                            $first  = 0;
                            $end    = 0;
                            $number = 1;
                            $no = 1;
                        @endphp
                        <table id="tabelabsen" class="table table-xs text-sm table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Urutan</th>
                                    <th>Pengajar</th>
                                    <th>Level</th>
                                    <th>Jenis</th>
                                    <th>Waktu</th>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    @for ($i = 1; $i <= 16; $i++)
                                    <th>{{ $i }}</th>
                                    @endfor
                                    <th>Total</th>
                                </tr>
                            </thead>
                                <tbody>
                        @foreach($jadwals as $key => $jadwal)
                            @php
                                $jadwal_ = $jadwal->hari_jadwal.' '.$jadwal->waktu_jadwal;
                                
                            @endphp
                            
                                    @php
                                        $no_ = 1;
                                    @endphp
                                    @foreach ( $jadwal->jumlahpeserta($jadwal->level_jadwal, $jadwal_, $jadwal->angkatan_jadwal) as $peserta)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td class="text-center">{{ $no_++ }}</td>
                                        <td>{{ $jadwal->pengajar_jadwal }}</td>
                                        <td>{{ $jadwal->level_jadwal }}</td>
                                        <td>{{ $jadwal->jenis_jadwal }}</td>
                                        <td>{{ $jadwal->hari_jadwal }} - {{ $jadwal->waktu_jadwal }}</td>
                                        <td>{{ $peserta->no_tahsin }}</td>
                                        <td>{{ $peserta->nama_peserta }}</td>
                                         @php
                                            $totalabsen = 0;
                                            $ab = DB::table('absens')->where('id_peserta', $peserta->id)->get();
                                            
                                            $yess = array();
                                            foreach ($ab as $a) {
                                                $yess[] = ([
                                                        'ke'   => $a->pertemuan_ke_absen,
                                                        'id_p' => $a->id_peserta,
                                                        'k_p'  => $a->keterangan_absen
                                                    ]);
                                            }
                                    
                                            $dataabsen        = collect($yess);
                                        @endphp
                                        @for ($i = 1; $i <= 16; $i++)
                                            <td class="text-center">
                                                @php
                                                    $cek = $dataabsen->where('id_p', $peserta->id)->where('ke', $i)->first()
                                                @endphp
                                                @isset($cek)
                                                    @if ($cek['k_p'] == 'HADIR')
                                                        1
                                                        <!--<i class="fas fa-check" style="font-size: 18px;color:dodgerblue"></i>-->
                                                        @php
                                                            $totalabsen = $totalabsen + 1;
                                                        @endphp
                                                    @elseif ($cek['k_p'] == 'TIDAK HADIR')
                                                        0
                                                        <!--<i class="fa-solid fa-circle-xmark" style="font-size: 18px;color:rgb(255, 30, 30)"></i>-->
                                                    @elseif ($cek['k_p'] != 'IZIN' || $cek['k_p'] != 'SAKIT')
                                                        0
                                                        <!--<i class="fa-solid fa-circle-xmark" style="font-size: 18px;color:rgb(254, 171, 15)"></i>-->
                                                    @else
                                                        -
                                                    @endif
                                                @endisset
                                            </td>
                                        @endfor
                                        <td>
                                            {{ $totalabsen }}
                                        </td>
                                    </tr>
                                    @endforeach
                                
                            
                            @php
                            $first  = $jadwals->firstItem();
                            $end    = $key + $jadwals->firstItem();
                            @endphp
                        @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-7">
            <div class="float-left">
                {!! $first !!} - {!! $end !!} Dari {!! $jadwals->total() !!} Data
            </div>
        </div><!--col-->

        <div class="col-5">
            <div class="float-right">
                {!! $jadwals->appends(request()->query())->links() !!}
            </div>
        </div><!--col-->
    </div><!--row-->

@endsection