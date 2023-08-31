<style>
    .table {
        border-radius: 0.2rem;
        width: 100%;
        padding-bottom: 1rem;
        color: #212529;
        margin-bottom: 0;
    }
    .table th:first-child,
    .table td:first-child {
        position: sticky;
        width: 60px;
        left: 0;
        background-color: #fff7e4;
        color: #373737;
    }
    .table td {
        white-space: nowrap;
    }
</style>
<table class="table table-bordered table-sm">
    <thead >
        <tr>
            <th style="vertical-align: middle;">
                Pertemuan
            </th>
            @for ($i = 1; $i <= 16; $i++)
                <th class="text-center" style="vertical-align: middle;">
                    {{ $i }}
                </th>
            @endfor
            <th style="vertical-align: middle;">
                Total Hadir
            </th>
            <th style="vertical-align: middle;">
                Hasil Ujian
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Tanggal Absen</td>
            @for ($i = 1; $i <= 16; $i++)
                <td class="small">
                    @php
                        $cektanggal = $dataketpertemuan->where('pert', $i)->first()
                    @endphp
                    @isset($cektanggal)
                        {{ $cektanggal['tgl'] }}
                    @endisset
                </td>
            @endfor
        </tr>
        <tr>
            <td>Tilawah Surah Terakhir</td>
            @for ($i = 1; $i <= 16; $i++)
                <td class="small">
                    @php
                        $cektilawah = $dataketpertemuan->where('pert', $i)->first()
                    @endphp
                    @isset($cektilawah)
                       QS. {{ $cektilawah['surah'] }} Ayat {{ $cektilawah['ayat'] }}
                    @endisset
                </td>
            @endfor
        </tr>
        @foreach ( $datapeserta as $peserta )
            <tr>
                <td class="text-left p-2">
                    <a href="#">
                        <div style="text-transform: uppercase; color:#222222; font-weight: 800; font-size: 12px">
                            @php
                                $nama = explode(" ", $peserta->nama_peserta)
                            @endphp
                            {{ $nama[0] ?? ''}} {{ $nama[1] ?? ''}} {!! !empty($nama[1]) ? '<br>' : '' !!}
                            {{ $nama[2] ?? ''}} {{ $nama[3] ?? ''}} {!! !empty($nama[3]) ? '<br>' : '' !!}
                            {{ $nama[4] ?? ''}} {{ $nama[5] ?? ''}} {!! !empty($nama[5]) ? '<br>' : '' !!}
                            {{ $nama[6] ?? ''}} {{ $nama[7] ?? ''}}
                        </div>
                    </a>
                    <div class="small text-muted pb-1">
                        {{ $peserta->no_tahsin }} | {{ $peserta->nohp_peserta }}
                    </div>
                </td>

                @php
                    $totalabsen = 0;
                @endphp
                @for ($i = 1; $i <= 16; $i++)
                    <td class="text-center">
                        @php
                            $cek = $dataabsen->where('id_p', $peserta->id)->where('ke', $i)->first()
                        @endphp
                        @isset($cek)
                            @if ($cek['k_p'] == 'HADIR')
                                <i class="fas fa-check" style="font-size: 18px;color:dodgerblue"></i>
                                @php
                                    $totalabsen = $totalabsen + 1;
                                @endphp
                            @elseif ($cek['k_p'] == 'TIDAK HADIR')
                                <i class="fa-solid fa-circle-xmark" style="font-size: 18px;color:rgb(255, 30, 30)"></i>
                            @elseif ($cek['k_p'] != 'IZIN' || $cek['k_p'] != 'SAKIT')
                                <i class="fa-solid fa-circle-xmark" style="font-size: 18px;color:rgb(254, 171, 15)"></i>
                            @else
                                -
                            @endif
                        @endisset
                    </td>
                @endfor
                <td>
                    {{ $totalabsen }}
                </td>
                <td>
                    {{ $peserta->kenaikan_level_peserta ?? '' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
