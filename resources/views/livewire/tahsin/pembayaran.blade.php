<div class="card-body">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="card-title mb-0 text-center">
                Pembayaran Tahsin<small class="text-muted"> - Angkatan 16</small>

                {{-- {{ __('backend_tahsins.labels.management') }} <small class="text-muted">{{ __('backend_tahsins.labels.active') }}</small> --}}
            </h4>
        </div><!--col-->
    </div><!--row-->

    <div class="row mt-4">
        <div class="col-md-1">
            <select class="form-control" wire:model="perPage">
                <option>5</option>
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
        </div>

        <div class="col">
        </div>

        <div class="col-md-2">
            <select class="pembayaran form-control" wire:model="pembayaran">
                <option>STATUS</option>
                <option value="1">BELUM LUNAS</option>
                <option value="2">LUNAS</option>
            </select>
        </div>

        <div class="col-md-4 pull-right">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-search"></i> </span>
                </div>
                <input wire:model.debounce.1000ms="search" class="form-control" type="text" placeholder="Cari Nama" autocomplete="password" width="100">
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <div class="table-responsive" style="min-width: 400px; padding: 0px 15px 15px 15px">
                <section>
                    <div class="row kotak-atas">
                        {{-- <div class="col-md-1">No</div> --}}
                        <div class="col">Nama</div>
                        <div class="col">Pengajar</div>
                        <div class="col"></div>
                        <div class="col text-center">Status</div>
                        <div class="col-md-2"></div>
                    </div>
                    @php
                    $first  = 0;
                    $end    = 0;
                    $number = 1;
                    @endphp
                    @foreach($tahsins as $key=> $tahsin)
                    <div class="row kotak">
                        {{-- <div class="col-md-1">{{ $key + $tahsins->firstItem() }}</div> --}}
                        <div class="col">
                            <a href="/admin/tahsins/{{ $tahsin->id }}" style="color: rgb(56, 56, 56);">
                                <div style="text-transform: uppercase;"><strong>{{ $tahsin->nama_peserta }}</strong></div>
                                <div class="small text-muted">
                                    {{ $tahsin->nohp_peserta }}<br>
                                    {{ $tahsin->level_peserta }} | {{ $tahsin->jadwal_tahsin }}
                                </div>
                            </a>
                        </div>
                        <div class="col" style="margin-left: 0px">
                            <div style="text-transform: uppercase;"><strong>{{ $tahsin->nama_pengajar }}</strong></div>
                            <div class="small text-muted">
                                {{ $tahsin->jenis_peserta }}<br>
                                ANGKATAN {{ $tahsin->angkatan_peserta }}
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center" style="padding-bottom: 5px">
                                <div class="text-value">0</div>
                                <div class="text-uppercase text-muted small">Pesan Whatsapp Terkirim</div>
                            </div>
                            <button class="btn btn-outline-success btn-pill btn-sm btn-block" >
                                Tahap Pengembangan
                            </button>
                            {{-- <div class="small text-center"> *chat pengingat pembayaran </div> --}}
                        </div>
                        <div class="col text-center" style="margin-top: 15px">
                            @php
                            $totalpembayaran = DB::table('pembayarans')
                                    ->select(DB::raw('SUM(nominal_pembayaran) as total'))
                                    ->where('id_peserta', $tahsin->no_tahsin)
                                    ->first();
                            @endphp
                            <div>
                                <strong>Rp. {{ number_format($totalpembayaran->total, 0, '.', '.') }} </strong>
                                <br>
                                / Rp. 400.000
                            </div>
                            <div class="small text-muted">
                                @if( $totalpembayaran->total < 400000 )
                                    <label class="badge badge-danger">BELUM LUNAS</label>
                                @else
                                    <label class="badge badge-success">LUNAS</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <center>
                                <form onsubmit="return confirm('Apakah Nominal Pembayaran Sudah Benar ?');" action="/admin/tahsin/createbayar" method="POST">
                                    {{ csrf_field() }}
                                    <input
                                        type="text" class="nominal form-control input-sm" style="margin: 10px 0 10px 0" value=""
                                        data-type="currency" placeholder="" required="" autofocus="" oninvalid="this.setCustomValidity('Diisi Nominal Pembayaran')"
                                        onchange="try{setCustomValidity('')}catch(e){}" oninput="setCustomValidity(' ')"
                                        @if ( $totalpembayaran->total >= 400000  )
                                            disabled
                                        @endif
                                        name="nominalpembayaran">
                                    <input type="hidden" name="jenispembayaran" value="TAHSIN">
                                    <input type="hidden" name="namapembayaran" value="{{ $tahsin->nama_peserta }} - {{ $tahsin->nohp_peserta }}, {{ $tahsin->level_peserta }} - {{ $tahsin->jadwal_tahsin }}">
                                    <input type="hidden" name="uuidpembayaran" value="{{ $tahsin->no_tahsin }}">
                                    <button class="btn btn-primary btn-sm btn-block"
                                        @if ( $totalpembayaran->total >= 400000  )
                                            disabled
                                        @endif
                                        >
                                        Bayar
                                    </button>
                                </form>
                            </center>
                        </div>
                        <div class="col-md-12">
                            <a data-toggle="collapse" href="#detail{{ $key + $tahsins->firstItem() }}" aria-expanded="false" style="padding-left: 15px">Riwayat Pembayaran</a>
                            {{-- <a data-toggle="collapse" href="#detailwa{{ $key + $tahsins->firstItem() }}" aria-expanded="false" style="padding-left: 35px">Riwayat Pesan WA</a> --}}
                        </div>
                        <div class="col-md-12" style="color: #4e4e4e">
                            <div class="col">
                                <div class="collapse" id="detail{{ $key + $tahsins->firstItem() }}" >
                                    <hr>
                                    <div class="row" style="font-weight: 600; padding-bottom: 10px;">
                                        <div class="col-md-1">No</div>
                                        <div class="col-md-2">Nominal</div>
                                        <div class="col-md-4">Admin</div>
                                        <div class="col-md-2">Waktu</div>
                                    </div>
                                    @php
                                    $noriwayat = 1;
                                    $riwayatpembayaran = DB::table('pembayarans')
                                            ->select('nominal_pembayaran', 'admin_pembayaran', 'created_at' )
                                            ->where('id_peserta', $tahsin->no_tahsin)
                                            ->get();
                                    @endphp
                                    @foreach($riwayatpembayaran as $riwayat)
                                        <div class="row">
                                            <div class="col-md-1"> {{ $noriwayat++ }} </div>
                                            <div class="col-md-2"> Rp. {{ number_format($riwayat->nominal_pembayaran, 0, '.', '.') }} </div>
                                            <div class="col-md-4"> {{ $riwayat->admin_pembayaran }} </div>
                                            <div class="col-md-2"> {{ $riwayat->created_at }}</div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="collapse" id="detailwa{{ $key + $tahsins->firstItem() }}" >
                                    <hr>
                                    tes WA
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                    $first  = $tahsins->firstItem();
                    $end    = $key + $tahsins->firstItem();
                    @endphp
                    @endforeach
                </section>
            </div>
        </div>
    </div>

    <div class="row" style="padding-top:10px">
        <div class="col-7">
            <div class="float-left" style="padding-left:10px">
                {!! $first !!} - {!! $end !!} Dari {!! $tahsins->total() !!} Data
            </div>
        </div><!--col-->

        <div class="col-5">
            <div class="float-right" style="padding-right:10px">
                {!! $tahsins->appends(request()->query())->links() !!}
            </div>
        </div><!--col-->
    </div><!--row-->
</div><!--card-body-->
