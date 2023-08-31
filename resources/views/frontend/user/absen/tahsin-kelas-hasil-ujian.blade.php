<table class="table table-sm">
    <thead>
        <tr>
            <th style="vertical-align: middle;">
                Peserta
            </th>
        </tr>
    </thead>
    <tbody>
        <form action="{{ route('frontend.user.absentahsininputlevel') }}" method="post">
            @foreach ( $datapeserta as $peserta )
                <tr>
                    <td class="text-left p-2">
                        <a href="https://wa.me/62{{ $peserta->nohp_peserta }}?text=Peserta Tahsin - {{ $peserta->nama_peserta }}" target="_blank">
                            <div style="text-transform: uppercase; color:#222222; font-weight: 800">{{ $peserta->nama_peserta }}</div>
                        </a>
                        <div class="small text-muted pb-1">
                            {{ $peserta->no_tahsin }} | {{ $peserta->nohp_peserta }}
                        </div>
                        @csrf
                        <input name="peserta[]" value="{{ $peserta->id  }}" hidden>
                        <input name="waktu" value="{{ $waktu }}" hidden>
                        <input name="jenis" value="{{ $jenis }}" hidden>
                        <input name="level" value="{{ $level }}" hidden>
                        <select style="font-weight: 700;" class="form-control" name="keteranganhasil{{ $peserta->id  }}">

                        @if ($peserta->kenaikanlevelhasil())
                            <option value="{{ $peserta->kenaikan_level_peserta }}">{{ $peserta->kenaikan_level_peserta }}</option>
                            <option value="">------</option>
                        @endif
                            <option value="">Pilih Kenaikan Level...</option>
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
                            <option value="TAJWIDI 1">TAJWIDI 1</option>

                        </select>
                    </td>
                </tr>
            @endforeach
            <tr class="bg-white">
                <td class="pt-4">
                    <div class="row">
                        <div class="col">
                            <div class="float-left">
                                <a href="#" onclick="goBack()" class="btn btn-info pr-3 pl-3">Kembali</a>
                            </div>
                            <script>
                                function goBack() {
                                    window.history.back();
                                }

                                $(document).ready(function(){
                                    $("#formabsen").on("submit", function(){
                                        $("#spinner").fadeIn();
                                    });//submit
                                });//document ready
                            </script>
                        </div>
                        <div class="col">
                            <div class="float-right">
                                <button class="btn btn-success pr-3 pl-3">Simpan <i class="fas fa-check"></i></button>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </form>
    </tbody>
</table>
@stack('before-scripts')
<script type="text/javascript">
    $(document).ready(function(){
            $("#ke").val("{!! $pertemuanke !!}");
    });
</script>
{{-- <script type="text/javascript">
    $( document ).ready(function() {
        $('#username').editable({
            type: 'text',
            pk: 1,
            url: '/post',
            title: 'Enter username'
        });
    });
</script> --}}

@stack('after-scripts')
