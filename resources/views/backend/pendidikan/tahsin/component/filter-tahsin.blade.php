<form action="{{ Request::fullUrl() }}" class="row">
    @if ( !isset(request()->page))
        <input type="hidden" name="page" value="1">
    @else
        <input type="hidden" name="page" value="{{ request()->page }}">
    @endif

    <div class="col">
        <div class="row">
            <div class="col-md">
                <div class="text-muted text-center" style="position: absolute">
                    Pengajar
                 </div>
                <select class="form-control mt-4" name="pengajar" onchange='if(this.value != 0) { this.form.submit(); }'>
                    <option value="SEMUA">SEMUA</option>
                    @foreach($datapengajars as $pengajar)
                        <option value="{{ $pengajar->nama_pengajar }}" {{ request()->pengajar == $pengajar->nama_pengajar ? 'selected' : '' }}>{{ $pengajar->nama_pengajar }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md">
                <div class="text-muted text-center" style="position: absolute">
                    Level
                 </div>
                <select class="form-control mt-4" name="level" onchange='if(this.value != 0) { this.form.submit(); }'>
                        <option value="SEMUA">SEMUA</option>
                        @foreach($datalevel as $level)
                            <option value="{{ $level->nama }}" {{ request()->level == $level->nama ? 'selected' : '' }}>{{ $level->nama }}</option>
                        @endforeach
                </select>
            </div>

            <div class="col-md">
                <div class="text-muted text-center" style="position: absolute">
                Angkatan
                 </div>
                <select class="form-control mt-4" name="angkatan" onchange='if(this.value != 0) { this.form.submit(); }'>
                    @foreach($dataangkatan as $angkatan)
                        <option value="{{ $angkatan->angkatan_peserta }}" {{ request()->angkatan == $angkatan->angkatan_peserta ? 'selected' : '' }}>{{ $angkatan->angkatan_peserta }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md">
                <div class="text-muted text-center" style="position: absolute">
                Jenis
                 </div>
                <select class="form-control mt-4" name="jenis" onchange='if(this.value != 0) { this.form.submit(); }'>
                    <option value="SEMUA">SEMUA</option>
                    <option value="IKHWAN" {{ request()->jenis == "IKHWAN" ? 'selected' : '' }}>IKHWAN</option>
                    <option value="AKHWAT" {{ request()->jenis == "AKHWAT" ? 'selected' : '' }}>AKHWAT</option>
                </select>
            </div>

            <div class="col-md">
                <div class="text-muted text-center" style="position: absolute">
                Status Peserta
                 </div>
                <select class="form-control mt-4" name="status_peserta" onchange='if(this.value != 0) { this.form.submit(); }'>
                    <option value="">SEMUA</option>
                    @foreach($liststatus as $status)
                        <option value="{{ $status->id }}" {{ request()->status_peserta == $status->id ? 'selected' : '' }}>{{ $status->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <div class="text-muted text-center" style="position: absolute">
                    Nama / No. Tahsin / No.Telp
                </div>
                <input name="cari" class="form-control mt-4" type="text" placeholder="" width="100" value="{{ request()->cari }}">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-1">
                <div class="text-muted text-center" style="position: absolute">
                    Per Page
                </div>
                <select class="form-control mt-4" name="perPage" onchange='if(this.value != 0) { this.form.submit(); }'>
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>
            {{-- <div class="col-md-2">
                <div class="text-muted text-center" style="position: absolute">
                    Tanggal
                </div>
                <input class="form-control mt-4 datepicker" value="{{ request()->tanggal }}" type="text" name="tanggal" id="" maxlength="11" size="11" onchange='if(this.value != 0) { this.form.submit(); }'>
            </div> --}}
            @if ($status_ == 'daftar-baru' || $status_ == 'belum-pilih-jadwal' || $status_ == 'selesai-daftar-baru' || $status_ == 'belum-selesai-diperiksa')
                <div class="col-md-2">
                    <div class="text-muted text-center" style="position: absolute">
                        Status Daftar Baru
                    </div>
                    <select class="form-control mt-4" id="status" name="daftar-baru" onchange='if(this.value != 0) { this.form.submit(); }'>
                        <option value="SEMUA">SEMUA</option>
                        <option value="1" {{ request()->input('daftar-baru') == 1 ? 'selected' : '' }}>Belum Selesai Diperiksa</option>
                        <option value="2" {{ request()->input('daftar-baru') == 2 ? 'selected' : '' }}>Belum Pilih Jadwal</option>
                        <option value="3" {{ request()->input('daftar-baru') == 3 ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
            @elseif ($status_ == 'daftar-ulang' || $status_ == 'belum-daftar-ulang')
                <div class="col-md-2">
                    <div class="text-muted text-center" style="position: absolute">
                    Status Daftar Ulang
                        </div>
                    <select class="form-control mt-4" id="status" name="daftar-ulang" onchange='if(this.value != 0) { this.form.submit(); }'>
                        <option value="1" {{ request()->input('daftar-ulang') == 1 ? 'selected' : '' }}>Selesai</option>
                        <option value="2" {{ request()->input('daftar-ulang') == 2 ? 'selected' : '' }}>Belum Daftar Ulang</option>
                    </select>
                </div>
            @elseif ($status_ == 'daftar-ujian' || request()->input('daftar-ujian'))
                <div class="col-md-2">
                    <div class="text-muted text-center" style="position: absolute">
                        Pendaftar Form Ujian
                    </div>
                    <select class="form-control mt-4" id="status" name="daftar-ujian" onchange='if(this.value != 0) { this.form.submit(); }'>
                        <option value="SEMUA" {{ request()->input('daftar-ujian') == 'SEMUA' ? 'selected' : '' }}>Semua</option>
                        <option value="1" {{ request()->input('daftar-ujian') == 1 ? 'selected' : '' }}>Daftar</option>
                        <option value="2" {{ request()->input('daftar-ujian') == 2 ? 'selected' : '' }}>Tidak Daftar</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="text-muted text-center" style="position: absolute">
                        Penilaian Ujian
                    </div>
                    <select class="form-control mt-4" id="status" name="proses-ujian" onchange='if(this.value != 0) { this.form.submit(); }'>
                        <option value="SEMUA" {{ request()->input('proses-ujian') == 'SEMUA' ? 'selected' : '' }}>Semua</option>
                        <option value="1" {{ request()->input('proses-ujian') == 1 ? 'selected' : '' }}>Selesai</option>
                        <option value="2" {{ request()->input('proses-ujian') == 2 ? 'selected' : '' }}>Belum Selesai</option>
                    </select>
                </div>
                @if (request()->input('proses-ujian') == 1)
                    <div class="col-md-2">
                        <div class="text-muted text-center" style="position: absolute">
                            Pilih Kenaikan Level
                        </div>
                        <select class="form-control mt-4" name="kenaikan-level" onchange='if(this.value != 0) { this.form.submit(); }'>
                            <option value="SEMUA">SEMUA</option>
                            @foreach($datalevel as $level)
                                <option value="{{ $level->nama }}" {{ request()->input('kenaikan-level') == $level->nama ? 'selected' : '' }}>{{ $level->nama }}</option>
                            @endforeach
                            <option value="TAJWIDI 1" {{ request()->input('kenaikan-level') == 'TAJWIDI 1' ? 'selected' : '' }}>TAJWIDI 1</option>
                    </select>
                    </div>
                @endif
            @elseif ($status_ == 'daftar-ujian-pembayaran')
                <div class="col-md-2">
                    <div class="text-muted text-center" style="position: absolute">
                        Penilaian Ujian
                    </div>
                    <select class="form-control mt-4" id="status" name="proses-ujian" onchange='if(this.value != 0) { this.form.submit(); }'>
                        <option value="SEMUA" {{ request()->input('proses-ujian') == 'SEMUA' ? 'selected' : '' }}>Semua</option>
                        <option value="1" {{ request()->input('proses-ujian') == 1 ? 'selected' : '' }}>Selesai</option>
                        <option value="2" {{ request()->input('proses-ujian') == 2 ? 'selected' : '' }}>Belum Selesai</option>
                    </select>
                </div>
                @if (request()->input('proses-ujian') == 1)
                    <div class="col-md-2">
                        <div class="text-muted text-center" style="position: absolute">
                            Pilih Kenaikan Level
                        </div>
                        <select class="form-control mt-4" name="kenaikan-level" onchange='if(this.value != 0) { this.form.submit(); }'>
                            <option value="SEMUA">SEMUA</option>
                            @foreach($datalevel as $level)
                                <option value="{{ $level->nama }}" {{ request()->input('kenaikan-level') == $level->nama ? 'selected' : '' }}>{{ $level->nama }}</option>
                            @endforeach
                            <option value="TAJWIDI 1" {{ request()->input('kenaikan-level') == 'TAJWIDI 1' ? 'selected' : '' }}>TAJWIDI 1</option>
                    </select>
                    </div>
                @endif
            @endif
            <div class="col-2 mt-4">
                <a href="#" class="btn btn-success">Export <i class="fas fa-file-excel"></i></a>
            </div>
            <div class="col"></div>
            <div class="col-md-2">
                <div class="text-right mt-4">
                    <button class="btn btn-info btn-block" type="submit">
                        <div class="float-left">
                            <i class="fas fa-search"></i>
                        </div>
                         Cari Data
                    </button>
                </div>
            </div>
        </div>
    </div>

</form>
