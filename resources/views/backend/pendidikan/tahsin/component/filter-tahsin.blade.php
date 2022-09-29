<form action="{{ Request::fullUrl() }}" class="row">
    @if ( !isset(request()->page))
        <input type="hidden" name="page" value="1">
    @else
        <input type="hidden" name="page" value="{{ request()->page }}">
    @endif

    <div class="col">
        <div class="row">
            <div class="col">
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

            <div class="col">
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

            <div class="col">
                <div class="text-muted text-center" style="position: absolute">
                Angkatan
                 </div>
                <select class="form-control mt-4" name="angkatan" onchange='if(this.value != 0) { this.form.submit(); }'>
                    @foreach($dataangkatan as $angkatan)
                        <option value="{{ $angkatan->angkatan_peserta }}" {{ request()->angkatan == $angkatan->angkatan_peserta ? 'selected' : '' }}>{{ $angkatan->angkatan_peserta }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col">
                <div class="text-muted text-center" style="position: absolute">
                Jenis
                 </div>
                <select class="form-control mt-4" name="jenis" onchange='if(this.value != 0) { this.form.submit(); }'>
                    <option value="SEMUA">SEMUA</option>
                    <option value="IKHWAN" {{ request()->jenis == "IKHWAN" ? 'selected' : '' }}>IKHWAN</option>
                    <option value="AKHWAT" {{ request()->jenis == "AKHWAT" ? 'selected' : '' }}>AKHWAT</option>
                </select>
            </div>

            <div class="col">
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

            <div class="col-3">
                <div class="text-muted text-center" style="position: absolute">
                    Nama / No. Tahsin / No.Telp
                </div>
                <input name="cari" class="form-control mt-4" type="text" placeholder="" width="100" value="{{ request()->cari }}">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-1">
                <select class="form-control mt-4" name="perPage" onchange='if(this.value != 0) { this.form.submit(); }'>
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>
            @if ($status_ == 'daftar-baru')
                <div class="col-md-2">
                    <div class="text-muted text-center" style="position: absolute">
                        Status Daftar Baru
                    </div>
                    <select class="form-control mt-4" id="status" name="status" onchange='if(this.value != 0) { this.form.submit(); }'>
                        <option value="SEMUA">SEMUA</option>
                        <option value="1">Belum Selesai Diperiksa</option>
                        <option value="2">Belum Pilih Jadwal</option>
                        <option value="3">Selesai</option>
                    </select>
                </div>
            @elseif ($status_ == 'daftar-ulang' || $status_ == 'daftar-ulang-1')
                <div class="col-md-2">
                    <div class="text-muted text-center" style="position: absolute">
                    Status Daftar Ulang
                        </div>
                    <select class="form-control mt-4" id="status" name="daftar-ulang" onchange='if(this.value != 0) { this.form.submit(); }'>
                        {{-- <option value="SEMUA">SEMUA</option> --}}
                        <option value="2" {{ request()->input('daftar-ulang') == 2 ? 'selected' : '' }}>Selesai</option>
                        <option value="1" {{ request()->input('daftar-ulang') == 1 ? 'selected' : '' }}>Belum Daftar Ulang</option>
                    </select>
                </div>
            @elseif ($status_ == 'daftar-ujian')
                <div class="col-md-2">
                    <div class="text-muted text-center" style="position: absolute">
                        Status Ujian
                    </div>
                    <select class="form-control mt-4" id="status" name="status" onchange='if(this.value != 0) { this.form.submit(); }'>
                        <option value="SEMUA">SEMUA</option>
                        <option value="1">Belum Daftar Ujian</option> <!-- mendapatkan kartu ujian, lunas maupun belum -->
                        <option value="2">Belum Dinilai</option>
                        <option value="3">Selesai</option>
                    </select>
                </div>
            @endif
            <div class="col"></div>
            <div class="col-2">
                <div class="text-right mt-4">
                    <button class="btn btn-info btn-block" type="submit">
                        <div class="float-left">
                            <i class="fas fa-search"></i>
                        </div>
                         Cari
                    </button>
                </div>
            </div>
        </div>
    </div>

</form>