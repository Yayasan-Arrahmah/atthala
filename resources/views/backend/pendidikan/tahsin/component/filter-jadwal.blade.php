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
                        <option value="{{ $angkatan->angkatan_jadwal }}" {{ request()->angkatan == $angkatan->angkatan_jadwal ? 'selected' : '' }}>{{ $angkatan->angkatan_jadwal }}</option>
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
                Status Belajar
                 </div>
                <select class="form-control mt-4" name="status" onchange='if(this.value != 0) { this.form.submit(); }'>
                    <option value="">SEMUA</option>
                    <option {{ request()->status == 'ONLINE' ? 'selected' : '' }} value="ONLINE">ONLINE</option>
                    <option {{ request()->status == 'OFFLINE' ? 'selected' : '' }} value="OFFLINE">OFFLINE</option>
                    <option {{ request()->status == 'ONLINE / OFFLINE' ? 'selected' : '' }} value="ONLINE / OFFLINE">ONLINE / OFFLINE</option>
                </select>
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
            <div class="col-md-3">
                <div class="text-muted text-center" style="position: absolute">
                    Waktu
                </div>
                <div class="row mt-4">
                    <div class="col-sm-6 pr-0">
                        <select name="hari" class="form-control" onchange='if(this.value != 0) { this.form.submit(); }'>
                            <option value="">Hari...</option>
                            <option {{ request()->hari == 'AHAD' ? 'selected' : '' }} value="AHAD">AHAD</option>
                            <option {{ request()->hari == 'SENIN' ? 'selected' : '' }} value="SENIN">SENIN</option>
                            <option {{ request()->hari == 'SELASA' ? 'selected' : '' }} value="SELASA">SELASA</option>
                            <option {{ request()->hari == 'RABU' ? 'selected' : '' }} value="RABU">RABU</option>
                            <option {{ request()->hari == 'KAMIS' ? 'selected' : '' }} value="KAMIS">KAMIS</option>
                            <option {{ request()->hari == 'JUMAT' ? 'selected' : '' }} value="JUMAT">JUMAT</option>
                            <option {{ request()->hari == 'SABTU' ? 'selected' : '' }} value="SABTU">SABTU</option>
                        </select>
                    </div>
                    <div class="col-sm-6 pl-0">
                        <select name="waktu" class="form-control" onchange='if(this.value != 0) { this.form.submit(); }'>
                            <option value="">Jam...</option>
                            @for ($i = 5; $i <= 25; $i++)
                                @php
                                    $jam_ = ($i < 10 ? '0'.$i : $i).':00';
                                @endphp
                                <option {{ request()->waktu == $jam_ ? 'selected' : '' }} value="{{ $jam_ }}">{{ $jam_ }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="col"></div>
            <div class="col-md-2">
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
