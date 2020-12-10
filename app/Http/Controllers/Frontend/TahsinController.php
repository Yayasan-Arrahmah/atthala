<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Tahsin;
use App\Models\PesertaUjian;
// use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Jadwal;
use DB;
use PDF;

class TahsinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('frontend.tahsin.pendaftaran');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function pendaftaran(Request $request)
    {
        $sesidaftar = Str::random(10);
        Session::put('sesidaftar', $sesidaftar);
        return view('frontend.tahsin.pendaftaran-ditutup', compact('sesidaftar'));
    }

    public function uploadktp(Request $request)
    {
        $file_ktp      = $request->file('filepond');
        $nama_file_ktp = session('daftar_ulang_angkatan_tahsin').'-'.Session::get('sesidaftar').'.'.$file_ktp->getClientOriginalExtension();
        Session::put('filektp', $nama_file_ktp); //membuat sesi nama file agar sesuai dengan pemilik pendaftar
        Storage::disk('ktp')->put($nama_file_ktp, File::get($file_ktp));
    }

    public function uploadrekaman(Request $request)
    {
        $file_rekaman      = $request->file('filepond');
        $nama_file_rekaman = session('daftar_ulang_angkatan_tahsin').'-'.Session::get('sesidaftar').'.'.$file_rekaman->getClientOriginalExtension();
        Session::put('filerekaman', $nama_file_rekaman); //membuat sesi nama file agar sesuai dengan pemilik pendaftar
        Storage::disk('rekaman')->put($nama_file_rekaman, File::get($file_rekaman));
    }

    public function uploadbuktitransfer(Request $request)
    {
        $file_bukti_transfer      = $request->file('filepond');
        $nama_file_bukti_transfer = session('daftar_ulang_angkatan_tahsin').'-'.Session::get('sesidaftar').'.'.$file_bukti_transfer->getClientOriginalExtension();
        Session::put('filebuktitransfer', $nama_file_bukti_transfer); //membuat sesi nama file agar sesuai dengan pemilik pendaftar
        Storage::disk('bukti-transfer')->put($nama_file_bukti_transfer, File::get($file_bukti_transfer));
    }

    public function uploadbuktitransferpesertaujian(Request $request)
    {
        if ($_SERVER['HTTP_HOST'] == 'atthala.arrahmahbalikpapan.or.id') {
            $file_bukti_transfer      = $request->file('filepond');
            $nama_file_bukti_transfer = Str::random(5).'-'.Carbon::now().'.'.$file_bukti_transfer->getClientOriginalExtension();
            Session::put('filebuktitransferujian', $nama_file_bukti_transfer); //membuat sesi nama file agar sesuai dengan pemilik pendaftar
            Storage::disk('bukti-transfer-atthala')->put($nama_file_bukti_transfer, File::get($file_bukti_transfer));
        } else {
            $file_bukti_transfer      = $request->file('filepond');
            $nama_file_bukti_transfer = Str::random(5).'-'.Carbon::now().'.'.$file_bukti_transfer->getClientOriginalExtension();
            Session::put('filebuktitransferujian', $nama_file_bukti_transfer); //membuat sesi nama file agar sesuai dengan pemilik pendaftar
            Storage::disk('bukti-transfer')->put($nama_file_bukti_transfer, File::get($file_bukti_transfer));
        }

    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'nama_peserta'           => 'required',
            'nohp_peserta'           => 'required',
            'jenis_peserta'          => 'required',
        ]);

        $tahsin     = new Tahsin;
        $pembayaran = new Pembayaran;

        $banyakid   = Tahsin::where('angkatan_peserta', session('daftar_ulang_angkatan_tahsin'))
                    ->where('no_tahsin', 'like', '%-'.session('daftar_ulang_angkatan_tahsin').'-%')
                    ->count();
        $generateid = $banyakid + 1;

        try {

            if ($request->jenis_peserta == "IKHWAN") {
                // $pilih_jadwal_peserta            = $request->pilih_jadwal_peserta;
                // $pilih_jadwal_cadangan_1_peserta = $request->pilih_jadwal_cadangan_1_peserta;
                // $pilih_jadwal_cadangan_2_peserta = $request->pilih_jadwal_cadangan_2_peserta;
                $jenisid                         = "TI";
            } elseif ($request->jenis_peserta == "AKHWAT") {
                // $pilih_jadwal_peserta            = $request->pilih_jadwal_peserta_hari . ' ' . $request->pilih_jadwal_peserta_jam;
                // $pilih_jadwal_cadangan_1_peserta = $request->pilih_jadwal_cadangan_1_peserta_hari . ' ' . $request->pilih_jadwal_cadangan_1_peserta_jam;
                // $pilih_jadwal_cadangan_2_peserta = $request->pilih_jadwal_cadangan_2_peserta_hari . ' ' . $request->pilih_jadwal_cadangan_2_peserta_jam;
                $jenisid                         = "TA";
            }

            $no_tahsin = $jenisid . '-'.session('daftar_ulang_angkatan_tahsin').'-' . str_pad($generateid, 4, '0', STR_PAD_LEFT);

            // $nominal_pembayaran  = 200000 + ($request->has('bayar_modul') === true ? 60000 : 0) + ($request->has('bayar_mushaf') === true ? 110000 : 0);
            $nominal_pembayaran  = 200000;
            $waktu_lahir_peserta = $request->tanggal_lahir . '-' . $request->bulan_lahir . '-' . $request->tahun_lahir;

            // FUNGSI UPLOAD VERSI LAMA
            // //upload ktp
            // $file_ktp      = $request->file('fotoktp_peserta');
            // $nama_file_ktp = $no_tahsin . ' ' . \Carbon\Carbon::now()->format('Y-m-d H:i:s') . '-KTP';
            // $extension_ktp = $file_ktp->getClientOriginalExtension();
            // Storage::disk('ktp')->put($nama_file_ktp . '.' . $extension_ktp, File::get($file_ktp));

            // //upload rekaman
            // $file_rekaman      = $request->file('rekaman_peserta');
            // $nama_file_rekaman = $no_tahsin . ' ' . \Carbon\Carbon::now()->format('Y-m-d H:i:s') . '-REKAMAN';
            // $extension_rekaman = $file_rekaman->getClientOriginalExtension();
            // Storage::disk('rekaman')->put($nama_file_rekaman . '.' . $extension_rekaman, File::get($file_rekaman));

            // //upload bukti transfer
            // $file_buktitf      = $request->file('bukti_transfer_peserta');
            // $nama_file_buktitf = $no_tahsin . ' ' . \Carbon\Carbon::now()->format('Y-m-d H:i:s') . '-BUKTI-RANSFER';
            // $extension_buktitf = $file_buktitf->getClientOriginalExtension();
            // Storage::disk('bukti-transfer')->put($nama_file_buktitf . '.' . $extension_buktitf, File::get($file_buktitf));

            $tahsin->no_tahsin                       = $no_tahsin;
            $tahsin->nama_peserta                    = $request->nama_peserta;
            $tahsin->nohp_peserta                    = $request->nohp_peserta;
            $tahsin->jenis_peserta                   = $request->jenis_peserta;
            $tahsin->angkatan_peserta                = session('daftar_ulang_angkatan_tahsin');
            $tahsin->alamat_peserta                  = $request->alamat_peserta;
            $tahsin->pekerjaan_peserta               = $request->pekerjaan_peserta;
            $tahsin->tempat_lahir_peserta            = $request->tempat_lahir_peserta;
            $tahsin->waktu_lahir_peserta             = $waktu_lahir_peserta;
            // $tahsin->pilih_jadwal_peserta            = $pilih_jadwal_peserta;
            // $tahsin->pilih_jadwal_cadangan_1_peserta = $pilih_jadwal_cadangan_1_peserta;
            // $tahsin->pilih_jadwal_cadangan_2_peserta = $pilih_jadwal_cadangan_2_peserta;
            $tahsin->fotoktp_peserta                 = Session::get('filektp');
            $tahsin->rekaman_peserta                 = Session::get('filerekaman');
            $tahsin->save();

            $pembayaran->id_peserta                = $tahsin->id;
            $pembayaran->nominal_pembayaran        = $nominal_pembayaran;
            $pembayaran->jenis_pembayaran          = "TAHSIN";
            $pembayaran->admin_pembayaran          = "TRANSFER";
            $pembayaran->bukti_transfer_pembayaran = Session::get('filebuktitransfer');
            $pembayaran->save();

            $nohp = $request->input('nohp_peserta');
            if (substr($nohp, 0, 1) === '0') {
                $nohp = substr($nohp, 1);
            } elseif (substr($nohp, 0, 2) === '62') {
                $nohp = substr($nohp, 2);
            } elseif (substr($nohp, 0, 3) === '+62') {
                $nohp = substr($nohp, 3);
            } else {
                $nohp = $nohp;
            }

            $apikey = 'gzUeDIPcqUzYRiupTR2wTRIUccaEizKs';
            $phone = '62' . $nohp;
            $message =
                "Assalamualaikum Warrohmarullah Wabarokatuh

Terima kasih telah mendaftarkan diri sebagai *Calon Peserta Tahsin Baru di angkatan ".session('daftar_ulang_angkatan_tahsin')."*.

Anda akan kami hubungi kembali secara otomatis melalui pesan WhatsApp setelah hasil bacaan Al Qur'an dikoreksi oleh tim penguji kami.

Adapun lama tunggu maksimal kami hubungi kembali adalah 3 hari setelah pendaftaran dilakukan.

Jazaakumullah Khoiron Katsiron,
Wassalamualaikum warahmatullahi wabarakatuh.

Salam,
Panitia Pendaftaran Baru Tahsin Angkatan ".session('daftar_ulang_angkatan_tahsin')."
*Lembaga Tahsin Tahfizhil Qur'an (LTTQ) Ar Rahmah Balikpapan*";

            $url = 'https://api.wanotif.id/v1/send';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, array(
                'Apikey'    => $apikey,
                'Phone'     => $phone,
                'Message'   => $message,
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            $info = "berhasil";
        } catch (\Throwable $th) {
            $info      = "gagal";
            $no_tahsin = "null";
        }
        return redirect()->route('frontend.tahsin.selesai', ['info' => $info, 'id' => $no_tahsin]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function selesai(Request $request)
    {
        $info = $request->info;
        $id   = $request->id;
        return view('frontend.tahsin.pendaftaran-selesai', compact('info', 'id'));
    }

    public function pdf(Request $request)
    {
        $data = Tahsin::where('no_tahsin', $request->id)->first();

        // $pdf = PDF::loadView('frontend.print.daftar', compact('data'));
        // return $pdf->download('pendaftaran-tahsin-16.pdf');

        return view('frontend.print.daftar', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tahsin  $tahsin
     * @return \Illuminate\Http\Response
     */
    public function show(Tahsin $tahsin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tahsin  $tahsin
     * @return \Illuminate\Http\Response
     */
    public function edit(Tahsin $tahsin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tahsin  $tahsin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tahsin $tahsin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tahsin  $tahsin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tahsin $tahsin)
    {
        //
    }

    public function caricalonpesertaujian(Tahsin $tahsin)
    {
        if (!empty(request('namapeserta'))) {
            $pencarian = DB::table('tahsins')
                ->where('nama_peserta', 'like', '%' . request('namapeserta') . '%')
                ->where('level_peserta', '=', request('level'))
                ->where('nama_pengajar', '=', request('pengajar'))
                ->paginate(15);
        } else {
            $pencarian = null;
        }
        $datapengajars = DB::table('tahsins')
            ->select('nama_pengajar')
            ->groupBy('nama_pengajar')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY nama_pengajar ASC'))
            ->get();

        $datalevel = DB::table('tahsins')
            ->select('level_peserta')
            ->groupBy('level_peserta')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY level_peserta ASC'))
            ->get();

        return view('frontend.tahsin.cari-calonpesertaujian', compact('datapengajars', 'datalevel', 'pencarian'));
    }


    public function calonpesertaujian(Request $request)
    {
        $notahsin = $request->get('id');
        $notelp   = $request->get('notelp');
        $angkatan = session('angkatan_tahsin');

        $calonpeserta = Tahsin::where('no_tahsin', $notahsin)
                            ->where('nohp_peserta', $notelp)
                            ->where('angkatan_peserta', $angkatan)
                            ->first();

        $cekterdaftarujian = PesertaUjian::where('no_tahsin', $notahsin)->where('angkatan_ujian', $angkatan)->first();

        return view('frontend.tahsin.calonpesertaujian', compact('calonpeserta', 'cekterdaftarujian'));
    }

    public function simpancalonpesertaujian(Request $request)
    {
        $angkatan = session('angkatan_tahsin');

        $this->validate($request, [
            'notelp'           => 'required',
            'pelunasan_tahsin' => 'required',
        ]);

        $pesertaujian = new PesertaUjian;

        $cekterdaftarujian = PesertaUjian::where('no_tahsin', $request->input('notahsin'))->where('angkatan_ujian', $angkatan)->first();

        if(isset($cekterdaftarujian)){
            $datacekpeserta = Tahsin::where('no_tahsin', $cekterdaftarujian->no_tahsin)->first();
            return redirect()->to('/tahsin/calon-peserta-ujian/daftar?id='.$cekterdaftarujian->no_tahsin.'&notelp='.$datacekpeserta->nohp_peserta);
        } else {

        try {

            $updatepeserta = Tahsin::where('no_tahsin',  $request->input('notahsin'))
                    ->update([
                        'nohp_peserta'         => $request->input('notelp'),
                        'tempat_lahir_peserta' => $request->input('tempat_lahir_peserta'),
                        'waktu_lahir_peserta'  => $request->input('tanggal_lahir_peserta').'-'.$request->input('bulan_lahir_peserta').'-'.$request->input('tahun_lahir_peserta')
                    ]);

            $uuid = Str::uuid();
            $pesertaujian->uuid             = $uuid;
            $pesertaujian->no_tahsin        = $request->get('notahsin');
            $pesertaujian->status_pelunasan = $request->get('pelunasan_tahsin');
            $pesertaujian->angkatan_ujian   = session('angkatan_tahsin');
            $pesertaujian->bukti_transfer   = Session::get('filebuktitransferujian');
            $pesertaujian->save();

            $nohp = $request->input('notelp');
            if (substr($nohp, 0, 1) === '0') {
                $nohp = substr($nohp, 1);
            } elseif (substr($nohp, 0, 2) === '62') {
                $nohp = substr($nohp, 2);
            } elseif (substr($nohp, 0, 3) === '+62') {
                $nohp = substr($nohp, 3);
            } else {
                $nohp = $nohp;
            }

            $apikey = 'gzUeDIPcqUzYRiupTR2wTRIUccaEizKs';
            $phone = '62' . $nohp;
            $message =
                "Assalamualaikum Warrohmarullah Wabarokatuh

Terima kasih telah mendaftarkan diri sebagai *Peserta Ujian Tahsin di angkatan ".session('angkatan_tahsin')."*.

Semoga Allah subhanahu Wa ta'ala senantiasa memberikan kemudahan dan keberkahan kepada saudara/i.

Tetap waspada dan jaga kesehatan diri dan keluarga sesuai dengan sunnah Baginda Rasulullah shallallahu 'alaihi wasallam.

Jazaakumullah Khoiron Katsiron,
Wassalamualaikum warahmatullahi wabarakatuh.

Salam,
Panitia Ujian Tahsin Angkatan ".session('angkatan_tahsin')."
*Lembaga Tahsin Tahfizhil Qur'an (LTTQ) Ar Rahmah Balikpapan*";

            $url = 'https://api.wanotif.id/v1/send';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, array(
                'Apikey'    => $apikey,
                'Phone'     => $phone,
                'Message'   => $message,
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            $info = "berhasil";
        } catch (\Throwable $th) {
            $info      = "gagal";
            $no_tahsin = "null";
        }
        // return redirect()->route('frontend.tahsin.printcalonpesertaujian', ['id' => $uuid]);
        return redirect()->to('/tahsin/calon-peserta-ujian/print?id='.$uuid);

        }

    }

    public function printcalonpesertaujian(Request $request)
    {
        $pesertaujian = PesertaUjian::where('uuid', $request->get('id'))->first();
        $notahsin     = $pesertaujian->no_tahsin;

        $data = Tahsin::where('no_tahsin', $notahsin)->first();

        // dd($data);
        // $data = ['created_at' => 'Welcome to belajarphp.net'];

        $pdf = PDF::loadView('frontend.tahsin.print-calonpesertaujian', $data)->setPaper('a5', 'landscape');
        // return $pdf->download('medium.pdf');
        return $pdf->stream($data->nama_peserta.' - Kartu Ujian Tahsin LTTQ Arrahmah Balikpapan.pdf');

        // return view('frontend.tahsin.print-calonpesertaujian', compact('data'));
    }

    public function caridaftarulangpeserta(Tahsin $tahsin)
    {
        if (!empty(request('namapeserta'))) {
            $pencarian = DB::table('tahsins')
                ->where('nama_peserta', 'like', '%' . request('namapeserta') . '%')
                ->where('level_peserta', '=', request('level'))
                ->where('nama_pengajar', '=', request('pengajar'))
                ->paginate(15);

        } else {
            $pencarian = null;
        }
        $datapengajars = DB::table('tahsins')
            ->select('nama_pengajar')
            ->groupBy('nama_pengajar')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY nama_pengajar ASC'))
            ->get();

        $datalevel = DB::table('tahsins')
            ->select('level_peserta')
            ->groupBy('level_peserta')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY level_peserta ASC'))
            ->get();

        return view('frontend.tahsin.cari-daftarulangpeserta', compact('datapengajars', 'datalevel', 'pencarian'));
    }

    public function daftarulangpeserta(Request $request)
    {
        $sesidaftar = Str::random(10);
        Session::put('sesidaftar', $sesidaftar);

        $notahsin            = $request->get('id');
        $angkatan            = session('angkatan_tahsin');
        $angkatandaftarulang = session('daftar_ulang_angkatan_tahsin');

        $calonpeserta = Tahsin::where('no_tahsin', $notahsin)
                            ->where('angkatan_peserta', $angkatan)
                            ->latest('created_at')
                            ->first();

        $cekterdaftarujian = Tahsin::where('no_tahsin', $notahsin)
                            ->where('angkatan_peserta', $angkatandaftarulang)
                            ->latest('created_at')
                            ->first();

        $jadwalhari  = $request->get('hari') ?? null;

        $hari     = Jadwal::where('angkatan_jadwal', $angkatandaftarulang)
                    ->where('jenis_jadwal', $calonpeserta->jenis_peserta)
                    ->where('level_jadwal', $calonpeserta->kenaikan_level_peserta ?? $calonpeserta->level_peserta)
                    ->where('jumlah_peserta', '<', 10)
                    ->select('hari_jadwal')
                    ->groupBy('hari_jadwal')
                    ->get();

        return view('frontend.tahsin.daftarulangpeserta', compact('calonpeserta', 'cekterdaftarujian', 'hari'));
    }

    public function simpandaftarulangpeserta(Request $request)
    {
        $angkatan = session('daftar_ulang_angkatan_tahsin');

        $this->validate($request, [
            'notelp'           => 'required',
        ]);

        $cekterdaftarpeserta = Tahsin::where('no_tahsin', $request->input('notahsin'))->where('angkatan_peserta', $angkatan)->first();

        if(isset($cekterdaftarpeserta)){
            return redirect()->to('/tahsin/daftar-ulang-peserta/daftar?id='.$cekterdaftarpeserta->no_tahsin);
        }

        $pesertadaftarulang = Tahsin::where('no_tahsin', $request->get('notahsin'))->latest('created_at')->first();
        $peserta            = new Tahsin;

        $datajadwal = Jadwal::where('angkatan_jadwal', $angkatan)
                        ->where('jenis_jadwal', $pesertadaftarulang->jenis_peserta)
                        ->where('hari_jadwal', $request->get('hari'))
                        ->where('waktu_jadwal', $request->get('waktu'))
                        ->where('level_jadwal', $pesertadaftarulang->kenaikan_level_peserta ?? $pesertadaftarulang->level_peserta)
                        ->where('jumlah_peserta', '<', 10)
                        ->first();

        // try {

            $nohp = $request->input('notelp');
            if (substr($nohp, 0, 1) === '0') {
                $nohp = substr($nohp, 1);
            } elseif (substr($nohp, 0, 2) === '62') {
                $nohp = substr($nohp, 2);
            } elseif (substr($nohp, 0, 3) === '+62') {
                $nohp = substr($nohp, 3);
            } else {
                $nohp = $nohp;
            }


            $peserta->no_tahsin            = $pesertadaftarulang->no_tahsin;
            $peserta->nama_peserta         = $pesertadaftarulang->nama_peserta;
            $peserta->jenis_peserta        = $pesertadaftarulang->jenis_peserta;
            $peserta->nohp_peserta         = $nohp;
            $peserta->level_peserta        = $pesertadaftarulang->kenaikan_level_peserta ?? $pesertadaftarulang->level_peserta;
            $peserta->nama_pengajar        = $datajadwal->pengajar_jadwal;
            $peserta->jadwal_tahsin        = $request->get('hari').' '.$request->get('waktu');
            $peserta->tempat_lahir_peserta = $request->input('tempat_lahir_peserta');
            $peserta->waktu_lahir_peserta  = $request->input('tanggal_lahir_peserta').'-'.$request->input('bulan_lahir_peserta').'-'.$request->input('tahun_lahir_peserta');
            $peserta->angkatan_peserta     = $angkatan;
            $peserta->status_pembayaran    = $request->get('pelunasan_tahsin');
            $peserta->save();

            $tambahpeserta = Jadwal::where('id',  $datajadwal->id)
                    ->update([
                        'jumlah_peserta' => $datajadwal->jumlah_peserta + 1,
                    ]);

            if ($request->get('pelunasan_tahsin') === 'SUDAH'){
                $pembayaran = new Pembayaran;
                $pembayaran->id_peserta                = $peserta->id;
                $pembayaran->nominal_pembayaran        = $request->input('nominaltf') ?? '0';
                $pembayaran->jenis_pembayaran          = "TAHSIN";
                $pembayaran->admin_pembayaran          = "TRANSFER";
                $pembayaran->bukti_transfer_pembayaran = Session::get('filebuktitransfer');
                $pembayaran->save();
            }

            $apikey = 'gzUeDIPcqUzYRiupTR2wTRIUccaEizKs';
            $phone = '62' . $nohp;
            $message =
                "Assalamualaikum Warrohmarullah Wabarokatuh

Terima kasih telah mendaftarkan ulang sebagai *Peserta Tahsin di angkatan ".session('daftar_ulang_angkatan_tahsin')."*.

Semoga Allah subhanahu Wa ta'ala senantiasa memberikan kemudahan dan keberkahan kepada saudara/i.

Tetap waspada dan jaga kesehatan diri dan keluarga sesuai dengan sunnah Baginda Rasulullah shallallahu 'alaihi wasallam.

Jazaakumullah Khoiron Katsiron,
Wassalamualaikum warahmatullahi wabarakatuh.

Salam,
Panitia Daftar Ulang Tahsin Angkatan ".session('daftar_ulang_angkatan_tahsin')."
*Lembaga Tahsin Tahfizhil Qur'an (LTTQ) Ar Rahmah Balikpapan*";

            $url = 'https://api.wanotif.id/v1/send';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, array(
                'Apikey'    => $apikey,
                'Phone'     => $phone,
                'Message'   => $message,
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            $info = "berhasil";


        // } catch (\Throwable $th) {
        //     $info      = "gagal";
        //     $no_tahsin = "null";
        // }
        return redirect()->to('/tahsin/daftar-ulang-peserta/print?id='.$request->get('notahsin'));

        // return redirect()->route('frontend.tahsin.printcalonpesertaujian', ['id' => $uuid]);
    }

    public function daftarulangpesertadatawaktu(Request $request)
    {
        $notahsin            = $request->get('id');
        $angkatan            = session('angkatan_tahsin');
        $angkatandaftarulang = session('daftar_ulang_angkatan_tahsin');
        $jadwalhari          = $request->get('hari');

        $calonpeserta = Tahsin::where('no_tahsin', $notahsin)
                            ->where('angkatan_peserta', $angkatan)
                            ->latest('created_at')
                            ->first();

        $waktu['data'] = Jadwal::where('angkatan_jadwal', $angkatandaftarulang)
                            ->where('jenis_jadwal', $calonpeserta->jenis_peserta)
                            ->where('level_jadwal', $calonpeserta->kenaikan_level_peserta ?? $calonpeserta->level_peserta)
                            ->where('jumlah_peserta', '<', 10)
                            ->where('hari_jadwal', $jadwalhari)
                            ->get();

        return response()->json($waktu);
    }

    public function printdaftarulangpeserta(Request $request)
    {
        $data = Tahsin::where('no_tahsin', $request->get('id'))->latest('created_at')->first();

        $pdf = PDF::loadView('frontend.tahsin.print-daftarulangpeserta', $data)->setPaper('a5', 'landscape');

        return $pdf->stream($data->nama_peserta.' - Kartu Daftar Ulang Tahsin LTTQ Arrahmah Balikpapan.pdf');
    }

    public function daftarcalonpeserta(Request $request)
    {
        $sesidaftar = Str::random(10);
        Session::put('sesidaftar', $sesidaftar);

        $notahsin            = $request->get('id');
        $angkatandaftarulang = session('daftar_ulang_angkatan_tahsin');

        $calonpeserta = Tahsin::where('no_tahsin', $notahsin)
                            ->where('angkatan_peserta', $angkatandaftarulang)
                            ->latest('created_at')
                            ->first();

        $cekterdaftar = Tahsin::where('no_tahsin', $notahsin)
                            ->where('angkatan_peserta', $angkatandaftarulang)
                            ->whereNotNull('jadwal_tahsin')
                            ->latest('created_at')
                            ->first();

        $jadwalhari  = $request->get('hari') ?? null;

        $hari     = Jadwal::where('angkatan_jadwal', $angkatandaftarulang)
                    ->where('jenis_jadwal', $calonpeserta->jenis_peserta)
                    ->where('level_jadwal', $calonpeserta->kenaikan_level_peserta ?? $calonpeserta->level_peserta)
                    ->where('jumlah_peserta', '<', 10)
                    ->select('hari_jadwal')
                    ->groupBy('hari_jadwal')
                    ->get();

        return view('frontend.tahsin.daftarcalonpeserta', compact('calonpeserta', 'cekterdaftar', 'hari'));
    }

    public function daftarcalonpesertawaktu(Request $request)
    {
        $notahsin            = $request->get('id');
        $angkatandaftarulang = session('daftar_ulang_angkatan_tahsin');
        $jadwalhari          = $request->get('hari');

        $calonpeserta = Tahsin::where('no_tahsin', $notahsin)
                            ->where('angkatan_peserta', $angkatandaftarulang)
                            ->latest('created_at')
                            ->first();

        $waktu['data'] = Jadwal::where('angkatan_jadwal', $angkatandaftarulang)
                            ->where('jenis_jadwal', $calonpeserta->jenis_peserta)
                            ->where('level_jadwal', $calonpeserta->level_peserta)
                            ->where('jumlah_peserta', '<', 10)
                            ->where('hari_jadwal', $jadwalhari)
                            ->get();

        return response()->json($waktu);
    }

    public function simpandaftarcalonpeserta(Request $request)
    {
        $angkatan = session('daftar_ulang_angkatan_tahsin');

        // $this->validate($request, [
        //     'notelp'           => 'required',
        // ]);

        $cekterdaftarpeserta = Tahsin::where('no_tahsin', $request->input('id'))->whereNotNull('jadwal_tahsin')->where('angkatan_peserta', $angkatan)->first();

        if(isset($cekterdaftarpeserta)){
            return redirect()->to('/tahsin/pendaftaran/peserta?id='.$cekterdaftarpeserta->no_tahsin);
        }

        $pesertadaftar = Tahsin::where('no_tahsin', $request->input('id'))->where('angkatan_peserta', $angkatan)->first();

        $datajadwal = Jadwal::where('angkatan_jadwal', $angkatan)
                        ->where('jenis_jadwal', $pesertadaftar->jenis_peserta)
                        ->where('hari_jadwal', $request->get('hari'))
                        ->where('waktu_jadwal', $request->get('waktu'))
                        ->where('level_jadwal', $pesertadaftar->level_peserta)
                        ->where('jumlah_peserta', '<', 10)
                        ->first();

        // try {

            $nohp = $pesertadaftar->nohp_peserta;
            if (substr($nohp, 0, 1) === '0') {
                $nohp = substr($nohp, 1);
            } elseif (substr($nohp, 0, 2) === '62') {
                $nohp = substr($nohp, 2);
            } elseif (substr($nohp, 0, 3) === '+62') {
                $nohp = substr($nohp, 3);
            } else {
                $nohp = $nohp;
            }

            $updatepeserta = Tahsin::where('no_tahsin', $request->get('id'))->where('angkatan_peserta', $angkatan)
                    ->update([
                        'nama_pengajar'        => $datajadwal->pengajar_jadwal,
                        'jadwal_tahsin'        => $request->get('hari').' '.$request->get('waktu'),
            ]);

            $tambahpeserta = Jadwal::where('id',  $datajadwal->id)
                    ->update([
                        'jumlah_peserta' => $datajadwal->jumlah_peserta + 1,
                    ]);

            $apikey = 'gzUeDIPcqUzYRiupTR2wTRIUccaEizKs';
            $phone = '62' . $nohp;
            $message =
                "Assalamualaikum Warrohmarullah Wabarokatuh

Terima kasih, Anda telah terverifikasi oleh Sistem Atthala sebagai Peserta Tahsin Angkatan ".session('daftar_ulang_angkatan_tahsin')." LTTQ Ar Rahmah Balikpapan.

Silakan melengkapi keperluan pembelajaran antara lain :
*1. Modul - Rp 35.000*
*2. Buku Prestasi - Rp 25.000*

Modul & Buku Prestasi bisa dibeli di Sekretariat LTTQ Ar Rahmah Balikpapan (Serambi Utara Masjid Ar Rahmah)
Senin - Jum'at : 09.00 - 17.00 WITA
Sabtu          : 09.00 - 12.00 WITA

Semoga Allah subhanahu Wa ta'ala senantiasa memberikan kemudahan dan keberkahan kepada saudara/i.

Tetap waspada dan jaga kesehatan diri dan keluarga sesuai dengan sunnah Baginda Rasulullah shallallahu 'alaihi wasallam.

Jazaakumullah Khoiron Katsiron,
Wassalamualaikum warahmatullahi wabarakatuh.

Salam,
Panitia Pendaftaran Baru Tahsin Angkatan ".session('daftar_ulang_angkatan_tahsin')."
*Lembaga Tahsin Tahfizhil Qur'an (LTTQ) Ar Rahmah Balikpapan*";

            $url = 'https://api.wanotif.id/v1/send';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, array(
                'Apikey'    => $apikey,
                'Phone'     => $phone,
                'Message'   => $message,
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            $info = "berhasil";


        // } catch (\Throwable $th) {
        //     $info      = "gagal";
        //     $no_tahsin = "null";
        // }
        return redirect()->to('/tahsin/pendaftaran/print?id='.$request->get('id'));

        // return redirect()->route('frontend.tahsin.printcalonpesertaujian', ['id' => $uuid]);
    }

    public function printdaftarpeserta(Request $request)
    {
        $data = Tahsin::where('no_tahsin', $request->get('id'))->where('angkatan_peserta', session('daftar_ulang_angkatan_tahsin'))->first();

        $pdf = PDF::loadView('frontend.tahsin.print-daftarpeserta', $data)->setPaper('a5', 'landscape');

        return $pdf->stream($data->nama_peserta.' - Kartu Pendaftaran Tahsin LTTQ Arrahmah Balikpapan.pdf');
    }
}
