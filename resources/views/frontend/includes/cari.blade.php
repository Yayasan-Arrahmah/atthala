<form action="{{ url()->current() }}">
    <div class="d-print-none row mt-4" style="padding-bottom:10px; margin-right: 0px;padding-left: 15px;">
        <div class="col-sm-3 alert-secondary" style="border: 1px solid #eee; padding-bottom: 10px" >
            <div style="padding-top: 5px; padding-bottom: 5px">
                <label class="form-check-label">Nama Peserta</label>
            </div>
            <input onkeyup="this.value = this.value.toUpperCase();"  oninvalid="setCustomValidity('Diisi Minimal 3 Huruf')" onchange="try{setCustomValidity('')}catch(e){}" class="form-control"  pattern=".{3,}" type="text" name="namapeserta" style="font-size: small" required/>
        </div>
        <div class="col alert-secondary" style="border: 1px solid #eee;">
            <div  style="padding-top: 5px; padding-bottom: 5px">
                <label class="form-check-label">Level Tahsin</label>
            </div>
            <div class="form-group" style="padding-left:0px">
                <select class="form-control" name="level" onchange="try{setCustomValidity('')}catch(e){}" oninvalid="setCustomValidity('Dipilih Terlebih Dahulu')" required>
                    {{-- <option value="ASAASI 1">ASAASI 1</option>
                    <option value="ASAASI 2">ASAASI 2</option>
                    <option value="TILAWAH ASAASI">TILAWAH ASAASI</option>
                    <option value="TAMHIDI">TAMHIDI</option>
                    <option value="TAWASUTHI">TAWASUTHI</option>
                    <option value="TILAWAH TAWASUTHI">TILAWAH TAWASUTHI</option>
                    <option value="IDADI">IDADI</option>
                    <option value="TAKMILI">TAKMILI</option>
                    <option value="TAHSINI">TAHSINI</option>
                    <option value="ITQON">ITQON</option> --}}
                    <option value="">Level Kelas...</option>
                    @foreach($datalevel as $level)
                        <option value="{{ $level->level_peserta }}">{{ $level->level_peserta }}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="col alert-secondary" style="border: 1px solid #eee;">
            <div  style="padding-top: 5px; padding-bottom: 5px">
                <label class="form-check-label">Pengajar</label>
            </div>
            <select name="pengajar" class="form-control" onchange="try{setCustomValidity('')}catch(e){}" oninvalid="setCustomValidity('Dipilih Terlebih Dahulu')" required>
                <option value="">Nama Pengajar...</option>
                @foreach($datapengajars as $pengajar)
                    <option value="{{ $pengajar->nama_pengajar }}">{{ $pengajar->nama_pengajar }}</option>
                @endforeach
            </select>
        </div>
        <div class="col alert-secondary" style="border: 1px solid #eee;">
            <div  style="padding-top: 5px; padding-bottom: 5px">
                <label class="form-check-label">Angkatan</label>
            </div>
            <select name="angkatan" class="form-control" onchange="try{setCustomValidity('')}catch(e){}" oninvalid="setCustomValidity('Dipilih Terlebih Dahulu')" required>
                <option value="20">20</option>
                <option value="19">19</option>
            </select>
        </div>
        <div class="col-md-2 alert-secondary" style="padding-top: 23px; border: 1px solid #eee; padding-bottom: 10px">
            <div class="align-middle">
                <button type="submit" class="btn btn-primary btn-pill btn-block" > <i class="fas fa-search"></i> Cari</button>
                </a>
            </div>
        </div>
    </div>
</form>
