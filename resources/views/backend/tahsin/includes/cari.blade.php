<form action="{{ url()->current() }}">
    <div class="d-print-none row mt-4" style="padding-bottom:20px; margin-right: 0px;padding-left: 15px;">
        <div class="col-sm-3 alert-secondary" style="border: 1px solid #eee;" >
            <div style="padding-top: 5px; padding-bottom: 5px">
                <label class="form-check-label">Nama Peserta</label>
            </div>
            <input class="form-control" type="text" name="namapeserta" style="font-size: small" />
        </div>
        <div class="col alert-secondary" style="border: 1px solid #eee;">
            <div  style="padding-top: 5px; padding-bottom: 5px">
                <label class="form-check-label">Level</label>
            </div>
            <div class="form-group" style="padding-left:0px">
                <select class="form-control" name="level">
                    <option value=" ">Semua</option>
                    <option value="ASAASI 1">ASAASI 1</option>
                    <option value="ASAASI 2">ASAASI 2</option>
                    <option value="TILAWAH ASAASI">TILAWAH ASAASI</option>
                    <option value="TAMHIDI">TAMHIDI</option>
                    <option value="TAWASUTHI">TAWASUTHI</option>
                    <option value="TILAWAH TAWASUTHI">TILAWAH TAWASUTHI</option>
                    <option value="IDADI">IDADI</option>
                    <option value="TAKMILI">TAKMILI</option>
                    <option value="TAHSINI">TAHSINI</option>
                    <option value="ITQON">ITQON</option>
                </select>
            </div>
        </div>
        <div class="col alert-secondary" style="border: 1px solid #eee;">
            <div  style="padding-top: 5px; padding-bottom: 5px">
                <label class="form-check-label" for="jenis2">Hari</label>
            </div>
            <div class="form-group" >
                <select class="form-control" name="hari">
                    <option value=" ">Semua</option>
                    <option value="SENIN">SENIN</option>
                    <option value="SELASA">SELASA</option>
                    <option value="RABU">RABU</option>
                    <option value="KAMIS">KAMIS</option>
                    <option value="JUMAT">JUMAT</option>
                    <option value="SABTU">SABTU</option>
                    <option value="AHAD">AHAD</option>
                </select>
            </div>
        </div>
        <div class="col alert-secondary" style="border: 1px solid #eee;">
            <div  style="padding-top: 5px; padding-bottom: 5px">
                <label class="form-check-label">Jenis</label>
            </div>
            <select name="jenis" class="form-control" required>
                <option value=" ">Semua</option>
                <option value="IKHWAN">IKHWAN</option>
                <option value="AKHWAT">AKHWAT</option>

            </select>
        </div>
        <div class="col alert-secondary" style="border: 1px solid #eee;">
            <div  style="padding-top: 5px; padding-bottom: 5px">
                <label class="form-check-label">Angkatan</label>
            </div>
            <select name="angkatan" class="form-control" required>
                <option value=" ">Semua </option>
                @for ($i = 1; $i <= 20; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="col alert-secondary" style="padding-top: 23px; border: 1px solid #eee;">
            <div class="align-middle">
                <button type="submit" class="btn btn-primary btn-pill btn-block" > <i class="fas fa-search"></i> Cari</button>
                {{-- <a href="#" title="Hapus" class="btn btn-primary"
                onclick="window.print()"
                style="cursor:pointer;" ><i class=" fas fa-print"></i>
                </a>
                <a href="/admin/nota" title="Refresh" class="btn btn-primary"
                onclick="$(this).find(&quot;form&quot;).submit();"
                style="cursor:pointer;" ><i class="fa fa-sync"></i> --}}
                </a>
            </div>
        </div>
    </div>
</form>
