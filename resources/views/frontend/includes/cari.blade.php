<form action="{{ url()->current() }}">
    <div class="d-print-none row mt-4" style="padding-bottom:20px; margin-right: 0px;padding-left: 15px;">
        <div class="col-sm-3 alert-secondary" style="border: 1px solid #eee;" >
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
                <select class="form-control" name="level">
                    <option value="ASAASI 1">ASAASI 1</option>
                    <option value="ASAASI 2">ASAASI 2</option>
                    <option value="TILAWAH ASAASI">TILAWAH ASAASI</option>
                    <option value="TAMHIDI">TAMHIDI</option>
                    <option value="TAWATSUTHI">TAWATSUTHI</option>
                    <option value="TILAWAH TAWATSUTHI">TILAWAH TAWATSUTHI</option>
                    <option value="I'DADI">I'DADI</option>
                    <option value="TAKMILI">TAKMILI</option>
                    <option value="TAHSINI">TAHSINI</option>
                    <option value="ITQON">ITQON</option>
                </select>
            </div>
        </div>
        <div class="col alert-secondary" style="border: 1px solid #eee;">
            <div  style="padding-top: 5px; padding-bottom: 5px">
                <label class="form-check-label">Ustad / Ustadzah</label>
            </div>
            <select name="pengajar" class="form-control" required>
                <option value="">Nama Pengajar...</option>
                @foreach($datapengajars as $pengajar)
                    <option value="{{ $pengajar->nama_pengajar }}">{{ $pengajar->nama_pengajar }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 alert-secondary" style="padding-top: 23px; border: 1px solid #eee;">
            <div class="align-middle">
                <button type="submit" class="btn btn-primary btn-pill btn-block" > <i class="fas fa-search"></i> Cari</button>
                </a>
            </div>
        </div>
    </div>
</form>
