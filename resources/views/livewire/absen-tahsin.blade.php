<div>
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12 text-center" style="font-weight: 600; padding-bottom: 20px ">
                            <div class="ab" >
                                <table class="table table-bordered table-striped table-sm" style="min-width: 800px; margin: 5px">
                                    <thead >
                                        <tr>
                                            <th width="200">Nama</th>
                                            @for ($i = 1; $i <= 16; $i++)
                                            <th width="200" class="text-center">{{ $i }}</th>
                                            @endfor
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($j = 1; $j <= 10; $j++)
                                        <tr>
                                            <td>Peserta {{ $j }}</td>
                                            @for ($i = 1; $i <= 16; $i++)
                                            <form wire:submit.prevent="absensi({{ $i }})">
                                                @csrf
                                                <td width="200" class="text-center">
                                                    <select wire:model="keteranganabsen{{ $i }}">
                                                        <option value="">-</option>
                                                        <option value="HADIR">HADIR</option>
                                                        <option value="TIDAK HADIR">TIDAK HADIR</option>
                                                        <option value="IZIN">IZIN</option>
                                                        <option value="SAKIT">SAKIT</option>
                                                    </select>
                                                </td>
                                            </form>
                                            @endfor
                                        </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--row-->
</div>
