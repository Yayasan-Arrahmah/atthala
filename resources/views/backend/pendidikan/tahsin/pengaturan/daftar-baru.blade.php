<div class="col-md-8 card p-1">
    <div class="row pt-2 pb-2 m-2">
        <div class="col-12">
            <h3 class="font-weight-bold">Daftar Baru</h3>
            <hr class="mt-1 mb-2">
        </div>
        <div class="col-12 pb-3">
            <table class="table-borderless" style="width: 100%">
                <tbody>
                    <tr class="font-weight-bold">
                        <td>Form Pendaftaran Baru</td>
                        <td>:</td>
                        <td style="width: 80px">
                            <input
                                class="form-control form-control-sm bg-white border-primary text-primary font-weight-bold text-center"
                                type="text" value="AKTIF" name="" id="" disabled>
                        </td>
                    </tr>
                    <tr class="font-weight-bold">
                        <td>Angkatan Pendaftaran Baru</td>
                        <td>:</td>
                        <td style="width: 80px">
                            <input class="form-control form-control-sm bg-white text-dark font-weight-bold text-center"
                                type="text" value="1" name="" id="" disabled>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12 text-right">
            <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#notifikasi-daftar-baru">Notifikasi <i class="fas fa-message"></i></button>
            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit-daftar-baru">Edit Status <i class="fas fa-pencil"></i></button>
        </div>
    </div>
</div>


<div class="modal fade" id="edit-daftar-baru" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Status Daftar Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table-borderless" style="width: 100%">
                    <tbody>
                        <tr class="font-weight-bold">
                            <td>Form Pendaftaran Baru</td>
                            <td>:</td>
                            <td style="width: 80px">
                                <select class="form-control form-control-sm" name="status" id="">
                                    <option value="1">AKTIF</option>
                                    <option value="0">TIDAK AKTIF</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="font-weight-bold">
                            <td>Angkatan Pendaftaran Baru</td>
                            <td>:</td>
                            <td style="width: 80px">
                                <input class="form-control form-control-sm" type="number" value="1" name="angkatan" id="">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="notifikasi-daftar-baru" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notifikasi Daftar Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
