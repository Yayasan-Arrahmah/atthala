<form id="formabsen" action="{{ route('frontend.user.absentahsininput') }}" method="post">
    <table class="table table-sm">
        <thead>
            <tr>
                <th style="vertical-align: middle;">
                    <div class="mx-auto row">
                        <input name="idketper" value="{{ $ketpertemuan->id ?? '' }}" hidden>
                        <input name="idjadwal" value="{{ $jadwal->id }}" hidden>
                        <input name="pertemuan" value="{{ $pertemuanke }}" hidden>
                        <input name="waktu" value="{{ $waktu }}" hidden>
                        <input name="jenis" value="{{ $jenis }}" hidden>
                        <input name="level" value="{{ $level }}" hidden>
                        <div class="col-5 text-right">
                            <label>Tanggal :</label>
                        </div>
                        <div class="col-7 text-left">
                            <input class="datepicker" value="{{ $ketpertemuan->tanggal_pertemuan ?? \Carbon\Carbon::now()->format('Y-m-d') }}" type="text" name="tanggalpertemuan" id="" maxlength="11" size="11">
                        </div>
                    </div>
                    <div class="mx-auto row pt-2">
                        <div class="col-12">
                            <label>Ayat Tilawah Quran Terakhir</label>
                        </div>
                        <div class="col-5 text-right">
                            <label class="small" style="font-size: 15px;">Quran Surah :</label>
                        </div>
                        <div class="col-7 text-left">
                            <select name="surah" id="surah" style="font-size: 15px; font-weight: 600; padding: 2px 3px">
                                <option value="">Pilih ...</option>
                                <option value="1">1. Al-Fatiha</option>
                                <option value="2">2. Al-Baqarah</option>
                                <option value="3">3. Al 'Imran</option>
                                <option value="4">4. An-Nisaa</option>
                                <option value="5">5. Al-Maaidah</option>
                                <option value="6">6. Al-An'aam</option>
                                <option value="7">7. Al-A'raaf</option>
                                <option value="8">8. Al-Anfaal</option>
                                <option value="9">9. At-Taubah</option>
                                <option value="10">10. Yunus</option>
                                <option value="11">11. Huud</option>
                                <option value="12">12. Yusuf</option>
                                <option value="13">13. Ar-Ra'ad</option>
                                <option value="14">14. Ibraheem</option>
                                <option value="15">15. Al-Hijr</option>
                                <option value="16">16. An-Nahl</option>
                                <option value="17">17. Al-Israa</option>
                                <option value="18">18. Al-Kahf</option>
                                <option value="19">19. Maryam</option>
                                <option value="20">20. Taha</option>
                                <option value="21">21. Al-Anbiya</option>
                                <option value="22">22. Al-Hajj</option>
                                <option value="23">23. Al-Muminun</option>
                                <option value="24">24. An-Nur</option>
                                <option value="25">25. Al-Furqaan</option>
                                <option value="26">26. Ash-Shu'araa</option>
                                <option value="27">27. An-Naml</option>
                                <option value="28">28. Al-Qasas</option>
                                <option value="29">29. Al-'Ankabut</option>
                                <option value="30">30. Ar-Ruum</option>
                                <option value="31">31. Luqmaan</option>
                                <option value="32">32. As-Sajdah</option>
                                <option value="33">33. Al-Ahzaab</option>
                                <option value="34">34. Saba</option>
                                <option value="35">35. Fatir</option>
                                <option value="36">36. Yasin</option>
                                <option value="37">37. As-Saffat</option>
                                <option value="38">38. Saad</option>
                                <option value="39">39. Az-Zumar</option>
                                <option value="40">40. Ghafir</option>
                                <option value="41">41. Fussilat</option>
                                <option value="42">42. Ash-Shura</option>
                                <option value="43">43. Az-Zukhruf</option>
                                <option value="44">44. Ad-Dukhan</option>
                                <option value="45">45. Al-Jathiya</option>
                                <option value="46">46. Al-Ahqaf</option>
                                <option value="47">47. Muhammad</option>
                                <option value="48">48. Al-Fath</option>
                                <option value="49">49. Al-Hujuraat</option>
                                <option value="50">50. Qaf</option>
                                <option value="51">51. Adh-Dhariyat</option>
                                <option value="52">52. At-Tur</option>
                                <option value="53">53. An-Najm</option>
                                <option value="54">54. Al-Qamar</option>
                                <option value="55">55. Ar-Rahman</option>
                                <option value="56">56. Al-Waqia</option>
                                <option value="57">57. Al-Hadid</option>
                                <option value="58">58. Al-Mujadila</option>
                                <option value="59">59. Al-Hashr</option>
                                <option value="60">60. Al-Mumtahina</option>
                                <option value="61">61. As-Saff</option>
                                <option value="62">62. Al-Jumua</option>
                                <option value="63">63. Al-Munafiqun</option>
                                <option value="64">64. At-Taghabun</option>
                                <option value="65">65. At-Talaq</option>
                                <option value="66">66. At-Tahrim</option>
                                <option value="67">67. Al-Mulk</option>
                                <option value="68">68. Al-Qalam</option>
                                <option value="69">69. Al-Haaqqah</option>
                                <option value="70">70. Al-Ma'arij</option>
                                <option value="71">71. Nuh</option>
                                <option value="72">72. Al-Jinn</option>
                                <option value="73">73. Al-Muzzammil</option>
                                <option value="74">74. Al-Muddaththir</option>
                                <option value="75">75. Al-Qiyamah</option>
                                <option value="76">76. Al-Insaan</option>
                                <option value="77">77. Al-Mursalat</option>
                                <option value="78">78. An-Naba</option>
                                <option value="79">79. An-Naziat</option>
                                <option value="80">80. Abasa</option>
                                <option value="81">81. At-Takwir</option>
                                <option value="82">82. Al-Infitar</option>
                                <option value="83">83. Al-Mutaffifin</option>
                                <option value="84">84. Al-Inshiqaaq</option>
                                <option value="85">85. Al-Buruj</option>
                                <option value="86">86. At-Tariq</option>
                                <option value="87">87. Al-A'la</option>
                                <option value="88">88. Al-Ghashiyah</option>
                                <option value="89">89. Al-Fajr</option>
                                <option value="90">90. Al-Balad</option>
                                <option value="91">91. Ash-Shams</option>
                                <option value="92">92. Al-Lail</option>
                                <option value="93">93. Ad-Duha</option>
                                <option value="94">94. Ash-Sharh</option>
                                <option value="95">95. At-Tin</option>
                                <option value="96">96. Al-'Alaq</option>
                                <option value="97">97. Al-Qadr</option>
                                <option value="98">98. Al-Bayyinah</option>
                                <option value="99">99. Az-Zalzalah</option>
                                <option value="100">100. Al-'Adiyat</option>
                                <option value="101">101. Al-Qariyah</option>
                                <option value="102">102. At-Takasur</option>
                                <option value="103">103. Al-'Asr</option>
                                <option value="104">104. Al-Humazah</option>
                                <option value="105">105. Al-Fil</option>
                                <option value="106">106. Quraysh</option>
                                <option value="107">107. Al-Maoun</option>
                                <option value="108">108. Al-Kausar</option>
                                <option value="109">109. Al-Kafirun</option>
                                <option value="110">110. An-Nasr</option>
                                <option value="111">111. Al-Masad</option>
                                <option value="112">112. Al-Ikhlaas</option>
                                <option value="113">113. Al-Falaq</option>
                                <option value="114">114. An-Nas</option>
                            </select>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                        $("#surah").val("{!! $ketpertemuan->tilawah_pertemuan_surah ?? '' !!}");
                                });
                            </script>
                        </div>
                        <div class="col-5 text-right">
                            <label class="small" style="font-size: 15px;">Ayat :</label>
                        </div>
                        <div class="col-7 text-left">
                            <input type="number" name="ayat" value="{{ $ketpertemuan->tilawah_pertemuan_ayat ?? '' }}" maxlength="3" size="3">
                        </div>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $datapeserta as $peserta )
                <tr>
                    <td class="text-left p-2">
                        <a href="https://wa.me/62{{ $peserta->nohp_peserta }}?text=Peserta Tahsin - {{ $peserta->nama_peserta }}" target="_blank">
                            <div style="text-transform: uppercase; color:#222222; font-weight: 800">
                                {{ $peserta->nama_peserta }}
                            </div>
                        </a>
                        <div class="small text-muted pb-1">
                            {{ $peserta->no_tahsin }} | {{ $peserta->nohp_peserta }}
                        </div>
                        @csrf
                        @php
                            $cek = $absen->where('id_peserta', $peserta->id )->where('pertemuan_ke_absen', request()->ke)->where('angkatan_absen', $angkatan)->first()
                        @endphp
                        <input name="peserta[]" value="{{ $peserta->id  }}" hidden>
                        <input name="idabsen[]" value="{{ $cek->id ?? null }}" hidden>
                        <div class="row">
                            <div class="col">
                                <div class="border rounded p-1 mb-1">
                                    <input id="idabsen{{ $peserta->id }}th" class="btn-check float-left mt-1 mr-2 ml-2" type="radio" name="keteranganabsen{{ $peserta->id }}" value="TIDAK HADIR" {{ isset($cek->keterangan_absen) ? ($cek->keterangan_absen == 'TIDAK HADIR' ? 'checked' : '') : 'checked'}} autocomplete="off">
                                    <label for="idabsen{{ $peserta->id }}th" id="idlabel{{ $peserta->id }}" class="btn p-0 m-0 mt-1 text-left btn-sm btn-block">TIDAK HADIR</label>
                                </div>
                                <div class="border rounded p-1">
                                    <input id="idabsen{{ $peserta->id }}s" class="btn-check float-left mt-1 mr-2 ml-2" type="radio" name="keteranganabsen{{ $peserta->id }}" value="SAKIT" {{ isset($cek->keterangan_absen) ? ($cek->keterangan_absen == 'SAKIT' ? 'checked' : '') : ''}} autocomplete="off">
                                    <label for="idabsen{{ $peserta->id }}s" id="idlabel{{ $peserta->id }}" class="btn p-0 m-0 mt-1 text-left btn-sm btn-block">SAKIT</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="border rounded p-1 mb-1">
                                    <input id="idabsen{{ $peserta->id }}h" class="btn-check float-left mt-1 mr-2 ml-2" type="radio" name="keteranganabsen{{ $peserta->id }}" value="HADIR" {{ isset($cek->keterangan_absen) ? ($cek->keterangan_absen == 'HADIR' ? 'checked' : '') : ''}} autocomplete="off">
                                    <label for="idabsen{{ $peserta->id }}h" id="idlabel{{ $peserta->id }}" class="btn p-0 m-0 mt-1 text-left btn-sm btn-block">HADIR</label>
                                </div>
                                <div class="border rounded p-1">
                                    <input id="idabsen{{ $peserta->id }}i" class="btn-check float-left mt-1 mr-2 ml-2" type="radio" name="keteranganabsen{{ $peserta->id }}" value="IZIN" {{ isset($cek->keterangan_absen) ? ($cek->keterangan_absen == 'IZIN' ? 'checked' : '') : ''}} autocomplete="off">
                                    <label for="idabsen{{ $peserta->id }}i" id="idlabel{{ $peserta->id }}" class="btn p-0 m-0 mt-1 text-left btn-sm btn-block">IZIN</label>
                                </div>
                            </div>
                        </div>
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
        </tbody>
    </table>
</form>

