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
use Image;

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
        return view('frontend.tahsin.pendaftaran', compact('sesidaftar'));
    }

    public function uploadktp(Request $request)
    {
        if ($_SERVER['HTTP_HOST'] == 'atthala.arrahmahbalikpapan.or.id') {
            $file_ktp      = $request->file('filepond');
            $nama_file_ktp = session('angkatan_tahsin').'-'.Str::random(5).'-'.Carbon::now().'.'.$file_ktp->getClientOriginalExtension();
            Session::put('filektp', $nama_file_ktp); //membuat sesi nama file agar sesuai dengan pemilik pendaftar
            // Storage::disk('bukti-transfer-atthala')->put($nama_file_ktp, File::get($file_ktp));

            $buktitf         = Image::make($file_ktp);
            $lokasibuktitf   = public_path('../../../public_html/atthala/app/public/ktp/');
            $buktitf->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $buktitf->save($lokasibuktitf.Session::get('filektp'));
        } else {
            $file_ktp      = $request->file('filepond');
            $nama_file_ktp = session('angkatan_tahsin').'-'.Str::random(5).'-'.Carbon::now().'.'.$file_ktp->getClientOriginalExtension();
            Session::put('filektp', $nama_file_ktp); //membuat sesi nama file agar sesuai dengan pemilik pendaftar
            // Storage::disk('bukti-transfer')->put($nama_file_ktp, File::get($file_ktp));

            $buktitf         = Image::make($file_ktp);
            $lokasibuktitf   = public_path('app/public/ktp/');
            $buktitf->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $buktitf->save($lokasibuktitf.Session::get('filektp'));
        }

        // $file_ktp      = $request->file('filepond');
        // $nama_file_ktp = session('daftar_ulang_angkatan_tahsin').'-'.Session::get('sesidaftar').'.'.$file_ktp->getClientOriginalExtension();
        // Session::put('filektp', $nama_file_ktp); //membuat sesi nama file agar sesuai dengan pemilik pendaftar
        // Storage::disk('ktp')->put($nama_file_ktp, File::get($file_ktp));
    }

    public function uploadrekaman(Request $request)
    {
        $file_rekaman      = $request->file('filepond');
        $nama_file_rekaman = session('angkatan_tahsin').'-'.Session::get('sesidaftar').'.'.$file_rekaman->getClientOriginalExtension();
        Session::put('filerekaman', $nama_file_rekaman); //membuat sesi nama file agar sesuai dengan pemilik pendaftar
        Storage::disk('rekaman')->put($nama_file_rekaman, File::get($file_rekaman));
    }

    public function uploadbuktitransfer(Request $request)
    {
        if ($_SERVER['HTTP_HOST'] == 'atthala.arrahmahbalikpapan.or.id') {
            $file_bukti_transfer      = $request->file('filepond');
            $nama_file_bukti_transfer = session('angkatan_tahsin').'-'.Str::random(5).'-'.Carbon::now().'.'.$file_bukti_transfer->getClientOriginalExtension();
            Session::put('filebuktitransfer', $nama_file_bukti_transfer); //membuat sesi nama file agar sesuai dengan pemilik pendaftar
            // Storage::disk('bukti-transfer-atthala')->put($nama_file_bukti_transfer, File::get($file_bukti_transfer));

            $buktitf         = Image::make($file_bukti_transfer);
            $lokasibuktitf   = public_path('../../../public_html/atthala/app/public/bukti-transfer/');
            $buktitf->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $buktitf->save($lokasibuktitf.Session::get('filebuktitransfer'));
        } else {
            $file_bukti_transfer      = $request->file('filepond');
            $nama_file_bukti_transfer = session('angkatan_tahsin').'-'.Str::random(5).'-'.Carbon::now().'.'.$file_bukti_transfer->getClientOriginalExtension();
            Session::put('filebuktitransfer', $nama_file_bukti_transfer); //membuat sesi nama file agar sesuai dengan pemilik pendaftar
            // Storage::disk('bukti-transfer')->put($nama_file_bukti_transfer, File::get($file_bukti_transfer));

            $buktitf         = Image::make($file_bukti_transfer);
            $lokasibuktitf   = public_path('app/public/ktp/');
            $buktitf->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $buktitf->save($lokasibuktitf.Session::get('filebuktitransfer'));
        }

        // $file_bukti_transfer      = $request->file('filepond');
        // $nama_file_bukti_transfer = session('daftar_ulang_angkatan_tahsin').'-'.Session::get('sesidaftar').'.'.$file_bukti_transfer->getClientOriginalExtension();
        // Session::put('filebuktitransfer', $nama_file_bukti_transfer); //membuat sesi nama file agar sesuai dengan pemilik pendaftar
        // Storage::disk('bukti-transfer')->put($nama_file_bukti_transfer, File::get($file_bukti_transfer));
    }

    public function uploadbuktitransferpesertaujian(Request $request)
    {
        if ($_SERVER['HTTP_HOST'] == 'atthala.arrahmahbalikpapan.or.id') {
            $file_bukti_transfer      = $request->file('filepond');
            $nama_file_bukti_transfer = Str::random(5).'-'.Carbon::now().'.'.$file_bukti_transfer->getClientOriginalExtension();
            Session::put('filebuktitransferujian', $nama_file_bukti_transfer); //membuat sesi nama file agar sesuai dengan pemilik pendaftar
            // Storage::disk('bukti-transfer-atthala')->put($nama_file_bukti_transfer, File::get($file_bukti_transfer));

            $buktitf         = Image::make($file_bukti_transfer);
            $lokasibuktitf   = public_path('../../../public_html/atthala/bukti-transfer-daftar-ujian/');
            $buktitf->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $buktitf->save($lokasibuktitf.Session::get('filebuktitransferujian'));
        } else {
            $file_bukti_transfer      = $request->file('filepond');
            $nama_file_bukti_transfer = Str::random(5).'-'.Carbon::now().'.'.$file_bukti_transfer->getClientOriginalExtension();
            Session::put('filebuktitransferujian', $nama_file_bukti_transfer); //membuat sesi nama file agar sesuai dengan pemilik pendaftar
            // Storage::disk('bukti-transfer')->put($nama_file_bukti_transfer, File::get($file_bukti_transfer));

            $buktitf         = Image::make($file_bukti_transfer);
            $lokasibuktitf   = public_path('bukti-transfer-daftar-ujian/');
            $buktitf->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $buktitf->save($lokasibuktitf.Session::get('filebuktitransferujian'));
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

        $banyakid   = $tahsin->where('angkatan_peserta', session('angkatan_tahsin'))
                    ->where('no_tahsin', 'like', '%-'.session('angkatan_tahsin').'-%')
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

            $no_tahsin = $jenisid . '-'.session('angkatan_tahsin').'-' . str_pad($generateid, 4, '0', STR_PAD_LEFT);

            // $nominal_pembayaran  = 200000 + ($request->has('bayar_modul') === true ? 60000 : 0) + ($request->has('bayar_mushaf') === true ? 110000 : 0);
            $nominal_pembayaran  = 200000;
            $waktu_lahir_peserta = $request->tanggal_lahir . '-' . $request->bulan_lahir . '-' . $request->tahun_lahir;


            // jika terdapat no tahsin sama, maka akan ditambhkan 1
            // if ($tahsin->fails()) {
            //     $generateid = $generateid + 1;
            //     $no_tahsin = $jenisid . '-'.'18'.'-' . str_pad($generateid, 4, '0', STR_PAD_LEFT);
            // }

            $tahsin->no_tahsin                       = $no_tahsin;
            $tahsin->nama_peserta                    = $request->nama_peserta;
            $tahsin->nohp_peserta                    = $request->nohp_peserta;
            $tahsin->jenis_peserta                   = $request->jenis_peserta;
            $tahsin->jenis_pembelajaran             = $request->jenis_pembelajaran;
            $tahsin->angkatan_peserta                = session('angkatan_tahsin');
            $tahsin->alamat_peserta                  = $request->alamat_peserta;
            $tahsin->pekerjaan_peserta               = $request->pekerjaan_peserta;
            $tahsin->tempat_lahir_peserta            = $request->tempat_lahir_peserta;
            $tahsin->waktu_lahir_peserta             = $waktu_lahir_peserta;
            $tahsin->pilih_jadwal_peserta            = $request->status_ ?? null;
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

            // $apikey  = 'gzUeDIPcqUzYRiupTR2wTRIUccaEizKs';
            $phone   = '+62' . $nohp;
            $message =
                "Assalamualaikum Warrohmarullah Wabarokatuh

Terima kasih telah mendaftarkan diri sebagai *Calon Peserta Tahsin Baru di angkatan ".session('angkatan_tahsin')."*.

Anda akan kami hubungi kembali secara otomatis melalui pesan WhatsApp setelah hasil bacaan Al Qur'an dikoreksi oleh tim penguji kami.

Adapun lama tunggu maksimal kami hubungi kembali adalah 3 hari setelah pendaftaran dilakukan.

Jazaakumullah Khoiron Katsiron,
Wassalamualaikum warahmatullahi wabarakatuh.

Salam,
Panitia Pendaftaran Baru Tahsin Angkatan ".session('angkatan_tahsin')."
*Lembaga Tahsin Tahfizhil Qur'an (LTTQ) Ar Rahmah Balikpapan*";

            // woo-wa.com
            $apikey = env('WA_KEY');

            $url='http://116.203.191.58/api/send_message';
            $data = array(
                "phone_no"  => $phone,
                "key"		=> $apikey,
                "message"	=> $message,
                "skip_link"	=> True // This optional for skip snapshot of link in message
            );
            $data_string = json_encode($data);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_VERBOSE, 0);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 360);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
            );
            echo $res=curl_exec($ch);
            curl_close($ch);

            // woo-wa.com kasir 6282155171933
        $phone   = '+6282155171933';
        $apikey = env('WA_KEY');
        $message =
            'Assalamualaikum Warohmatullahi Wabarokaatuh,
*Ini adalah pesan otomatis.*

Telah dikirimkan pembayaran Daftar Baru & SPP Bulan Pertama dengan detail sebagai berikut :

Nama Peserta : '.$tahsin->nama_peserta.'
NIS : '.$tahsin->no_tahsin.'
Nominal SPP : '.$nominal_pembayaran.'
Keterangan : Daftar Baru & SPP Bulan Pertama
Kontak : wa.me/62'.$tahsin->nohp_peserta.'

Klik link berikut untuk memeriksa riwayat pembayaran
https://atthala.arrahmahbalikpapan.or.id/admin/tahsin/daftar-baru?nama='.str_replace(' ', '+', $tahsin->nama_peserta);

        $url='http://116.203.191.58/api/send_message';
        $data = array(
            "phone_no"  => $phone,
            "key"		=> $apikey,
            "message"	=> $message,
            "skip_link"	=> True // This optional for skip snapshot of link in message
        );
        $data_string = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 360);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );
        echo $res=curl_exec($ch);
        curl_close($ch);

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
                ->where('angkatan_peserta', '=', session('daftar_ujian'))
                ->paginate(15);
        } else {
            $pencarian = null;
        }
        $datapengajars = DB::table('tahsins')
            ->select('nama_pengajar')
            ->groupBy('nama_pengajar')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY nama_pengajar ASC'))
            ->where('angkatan_peserta', '=', session('daftar_ujian'))
            ->get();

        $datalevel = DB::table('tahsins')
            ->select('level_peserta')
            ->groupBy('level_peserta')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY level_peserta ASC'))
            ->where('angkatan_peserta', '=', session('daftar_ujian'))
            ->get();

        return view('frontend.tahsin.cari-calonpesertaujian', compact('datapengajars', 'datalevel', 'pencarian'));
    }


    public function calonpesertaujian(Request $request)
    {
        $notahsin = $request->get('id');
        $notelp   = $request->get('notelp');
        $angkatan = session('daftar_ujian');

        $calonpeserta = Tahsin::where('no_tahsin', $notahsin)
                            ->where('nohp_peserta', $notelp)
                            ->where('angkatan_peserta', $angkatan)
                            ->first();

        $cekterdaftarujian = PesertaUjian::where('no_tahsin', $notahsin)->where('angkatan_ujian', $angkatan)->first();

        return view('frontend.tahsin.calonpesertaujian', compact('calonpeserta', 'cekterdaftarujian'));
    }

    public function simpancalonpesertaujian(Request $request)
    {
        $angkatan = session('daftar_ujian');

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

        // try {

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
            $pesertaujian->angkatan_ujian   = session('daftar_ujian');
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

            $phone = '+62'. $nohp;
            $message =
                "Assalamualaikum Warrohmarullah Wabarokatuh

Terima kasih telah mendaftarkan diri sebagai *Peserta Ujian Tahsin di angkatan ".session('daftar_ujian')."*.

Semoga Allah subhanahu Wa ta'ala senantiasa memberikan kemudahan dan keberkahan kepada saudara/i.

Tetap waspada dan jaga kesehatan diri dan keluarga sesuai dengan sunnah Baginda Rasulullah shallallahu 'alaihi wasallam.

Jazaakumullah Khoiron Katsiron,
Wassalamualaikum warahmatullahi wabarakatuh.

Salam,
Panitia Ujian Tahsin Angkatan ".session('daftar_ujian')."
*Lembaga Tahsin Tahfizhil Qur'an (LTTQ) Ar Rahmah Balikpapan*";

            // wanotif.id
            // $apikey = 'gzUeDIPcqUzYRiupTR2wTRIUccaEizKs';

            // $url = 'https://api.wanotif.id/v1/send';

            // $curl = curl_init();
            // curl_setopt($curl, CURLOPT_URL, $url);
            // curl_setopt($curl, CURLOPT_HEADER, 0);
            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            // curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            // curl_setopt($curl, CURLOPT_POST, 1);
            // curl_setopt($curl, CURLOPT_POSTFIELDS, array(
            //     'Apikey'    => $apikey,
            //     'Phone'     => $phone,
            //     'Message'   => $message,
            // ));
            // $response = curl_exec($curl);
            // curl_close($curl);

            // woo-wa.com
            $apikey = env('WA_KEY');

            $url='http://116.203.191.58/api/send_message';
                $data = array(
                    "phone_no"  => $phone,
                    "key"		=> $apikey,
                    "message"	=> $message,
                    "skip_link"	=> True // This optional for skip snapshot of link in message
                );
                $data_string = json_encode($data);

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_VERBOSE, 0);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
                curl_setopt($ch, CURLOPT_TIMEOUT, 360);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string))
                );
                echo $res=curl_exec($ch);
                curl_close($ch);

        //     $info = "berhasil";
        // } catch (\Throwable $th) {
        //     $info      = "gagal";
        //     $no_tahsin = "null";
        // }
        // return redirect()->route('frontend.tahsin.printcalonpesertaujian', ['id' => $uuid]);
        return redirect()->to('/tahsin/calon-peserta-ujian/print?id='.$uuid);

        }

    }

    public function printcalonpesertaujian(Request $request)
    {
        $pesertaujian = PesertaUjian::where('uuid', $request->get('id'))->first();
        $notahsin     = $pesertaujian->no_tahsin;

        $data = Tahsin::where('no_tahsin', $notahsin)->where('angkatan_peserta', session('daftar_ujian'))->first();

        // dd($data);

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
                ->where('angkatan_peserta', '=', session('daftar_ujian'))
                ->paginate(15);

        } else {
            $pencarian = null;
        }
        $datapengajars = DB::table('tahsins')
            ->select('nama_pengajar')
            ->groupBy('nama_pengajar')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY nama_pengajar ASC'))
            ->where('angkatan_peserta', '=', session('daftar_ujian'))
            ->get();

        $datalevel = DB::table('tahsins')
            ->select('level_peserta')
            ->groupBy('level_peserta')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY level_peserta ASC'))
            ->where('angkatan_peserta', '=', session('daftar_ujian'))
            ->get();

        return view('frontend.tahsin.cari-daftarulangpeserta', compact('datapengajars', 'datalevel', 'pencarian'));
    }

    public function daftarulangpeserta(Request $request)
    {
        $sesidaftar = Str::random(10);
        Session::put('sesidaftar', $sesidaftar);

        $notahsin            = $request->get('id');
        $id                  = $request->get('idt');
        $nama                = $request->get('nama');
        // $angkatan            = session('angkatan_tahsin');
        // $angkatandaftarulang = session('daftar_ulang_angkatan_tahsin');

        $angkatan            = session('daftar_ujian');
        $angkatandaftarulang = session('angkatan_tahsin');

        // ngambil data profile
        $calonpeserta = Tahsin::where('no_tahsin', $notahsin)
                            ->where('id', $id)
                            ->where('angkatan_peserta', $angkatan)
                            ->latest('created_at')
                            ->first();

        //verifikasi kalu sudah terdata
        $cekterdaftarujian = Tahsin::where('no_tahsin', $notahsin)
                            ->where('angkatan_peserta', $angkatandaftarulang)
                            ->latest('created_at')
                            ->first();

        //cek banyak data kelas sesuai level
        $ceklevel = Jadwal::where('angkatan_jadwal', $angkatandaftarulang)
                            ->where('jenis_jadwal', $calonpeserta->jenis_peserta)
                            ->where('level_jadwal', $calonpeserta->kenaikan_level_peserta ?? $calonpeserta->level_peserta)
                            ->get();

        $hari_[] = ['hari_jadwal' => 'Pilih Hari...', 'data' => ''];
        // dd($ceklevel);
        foreach ($ceklevel as $level) {
            $cekbanyakpeserta = null;
            $cekbanyakpeserta = Tahsin::where('level_peserta', $level->level_jadwal)
                                ->where('jadwal_tahsin', $level->hari_jadwal.' '.$level->waktu_jadwal)
                                ->where('angkatan_peserta', $level->angkatan_jadwal)
                                ->where('jenis_peserta', $level->jenis_jadwal)
                                ->get();
            if ($cekbanyakpeserta->count() < $level->jumlah_peserta) {
                $hari_[] = ['hari_jadwal' => $level->hari_jadwal, 'data' => $level->hari_jadwal];
            }
        }
        $hari = collect($hari_)->groupBy('hari_jadwal');
        $jadwalhari  = $request->get('hari') ?? null;

        // $hari     = Jadwal::where('angkatan_jadwal', $angkatandaftarulang)
        //             ->where('jenis_jadwal', $calonpeserta->jenis_peserta)
        //             ->where('level_jadwal', $calonpeserta->kenaikan_level_peserta ?? $calonpeserta->level_peserta)
        //             ->select('hari_jadwal')
        //             ->groupBy('hari_jadwal')
        //             ->get();

        return view('frontend.tahsin.daftarulangpeserta', compact('calonpeserta', 'cekterdaftarujian', 'hari'));
    }

    public function daftarulangpesertadatawaktu(Request $request)
    {
        $id           = $request->get('id');
        // $angkatan            = session('angkatan_tahsin');
        // $angkatandaftarulang = session('daftar_ulang_angkatan_tahsin');
        // $angkatan            = '18';
        $angkatandaftarulang = session('angkatan_tahsin');
        $jadwalhari          = $request->get('hari');

        $calonpeserta = Tahsin::where('id', $id)
                            ->first();

        //cek banyak data jam sesuai level
        $ceklevel = Jadwal::where('angkatan_jadwal', $angkatandaftarulang)
                    ->where('jenis_jadwal', $calonpeserta->jenis_peserta)
                    ->where('level_jadwal', $calonpeserta->kenaikan_level_peserta ?? $calonpeserta->level_peserta)
                    ->where('hari_jadwal', $jadwalhari)
                    ->orderBy('waktu_jadwal', 'ASC')
                    ->get();

        // $waktu_[] = ['waktu_jadwal' => '-----', 'id' => ''];
        // dd($ceklevel);
        foreach ($ceklevel as $level) {
            $cekbanyakpeserta = null;
            $cekbanyakpeserta = Tahsin::where('level_peserta', $level->level_jadwal)
                                ->where('jadwal_tahsin', $level->hari_jadwal.' '.$level->waktu_jadwal)
                                ->where('angkatan_peserta', $angkatandaftarulang)
                                ->where('jenis_peserta', $level->jenis_jadwal)
                                ->count();
            if ($cekbanyakpeserta < $level->jumlah_peserta) {
                $waktu_[] = ['waktu_jadwal' => $level->waktu_jadwal, 'id' => $level->id, 'status' => ''];
            } else {
                $waktu_[] = ['waktu_jadwal' => 'Maaf Jadwal Penuh', 'id' => '', 'status' => 'disabled'];
            }
        }
        // $waktu = collect($waktu_)->get();
        $waktu = collect($waktu_)->values();

        // $waktu['data'] = Jadwal::where('angkatan_jadwal', $angkatandaftarulang)
        //                     ->where('jenis_jadwal', $calonpeserta->jenis_peserta)
        //                     ->where('level_jadwal', $calonpeserta->kenaikan_level_peserta ?? $calonpeserta->level_peserta)
        //                     ->where('hari_jadwal', $jadwalhari)
        //                     ->get();

        return response()->json($waktu);
    }

    public function simpandaftarulangpeserta(Request $request)
    {
        $angkatan = session('daftar_ulang_angkatan_tahsin');
        $angkatan = session('angkatan_tahsin');

        $this->validate($request, [
            'notelp'           => 'required',
        ]);

        $cekterdaftarpeserta = Tahsin::where('no_tahsin', $request->input('notahsin'))
                                ->where('angkatan_peserta', $angkatan)
                                ->where('nama_peserta', $request->input('nama'))
                                ->first();


        if(isset($cekterdaftarpeserta)){
            return redirect()->to('/tahsin/daftar-ulang-peserta-XX/daftar?id='.$cekterdaftarpeserta->no_tahsin.'&idt='.$cekterdaftarpeserta->id.'&nama='.$cekterdaftarpeserta->nama);
        }

        $pesertadaftarulang = Tahsin::find($request->input('idt'));
        $peserta            = new Tahsin;

        $datajadwal = Jadwal::where('id', $request->get('waktu'))->first();

        try {

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
            $peserta->jenis_pembelajaran   = $pesertadaftarulang->jenis_pembelajaran;
            $peserta->nohp_peserta         = $nohp;
            $peserta->level_peserta        = $pesertadaftarulang->kenaikan_level_peserta ?? $pesertadaftarulang->level_peserta;
            $peserta->nama_pengajar        = $datajadwal->pengajar_jadwal;
            $peserta->jadwal_tahsin        = $datajadwal->hari_jadwal.' '.$datajadwal->waktu_jadwal;
            $peserta->tempat_lahir_peserta = $request->input('tempat_lahir_peserta');
            $peserta->waktu_lahir_peserta  = $request->input('tanggal_lahir_peserta').'-'.$request->input('bulan_lahir_peserta').'-'.$request->input('tahun_lahir_peserta');
            $peserta->angkatan_peserta     = $angkatan;
            $peserta->status_pembayaran    = $request->get('pelunasan_tahsin');
            $peserta->save();

            // $tambahpeserta = Jadwal::where('id',  $datajadwal->id)
            //         ->update([
            //             'jumlah_peserta' => $datajadwal->jumlah_peserta + 1,
            //         ]);

            // if ($request->get('pelunasan_tahsin') === 'SUDAH'){
                $pembayaran = new Pembayaran;
                $pembayaran->id_peserta                = $peserta->id;
                $pembayaran->nominal_pembayaran        = $request->input('nominaltf') ?? '0';
                $pembayaran->jenis_pembayaran          = "TAHSIN";
                $pembayaran->admin_pembayaran          = "TRANSFER";
                $pembayaran->bukti_transfer_pembayaran = Session::get('filebuktitransfer');
                $pembayaran->save();
            // }

            $phone = '+62'. $nohp;
            $message =
                "Assalamualaikum Warrohmarullah Wabarokatuh

Terima kasih telah mendaftarkan ulang sebagai *Peserta Tahsin di angkatan ".session('angkatan_tahsin')."*.

Semoga Allah subhanahu Wa ta'ala senantiasa memberikan kemudahan dan keberkahan kepada saudara/i.

Tetap waspada dan jaga kesehatan diri dan keluarga sesuai dengan sunnah Baginda Rasulullah shallallahu 'alaihi wasallam.

Jazaakumullah Khoiron Katsiron,
Wassalamualaikum warahmatullahi wabarakatuh.

Salam,
Panitia Daftar Ulang Tahsin Angkatan ".session('angkatan_tahsin')."
*Lembaga Tahsin Tahfizhil Qur'an (LTTQ) Ar Rahmah Balikpapan*";

            // $apikey = 'gzUeDIPcqUzYRiupTR2wTRIUccaEizKs';

            // $url = 'https://api.wanotif.id/v1/send';

            // $curl = curl_init();
            // curl_setopt($curl, CURLOPT_URL, $url);
            // curl_setopt($curl, CURLOPT_HEADER, 0);
            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            // curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            // curl_setopt($curl, CURLOPT_POST, 1);
            // curl_setopt($curl, CURLOPT_POSTFIELDS, array(
            //     'Apikey'    => $apikey,
            //     'Phone'     => $phone,
            //     'Message'   => $message,
            // ));
            // $response = curl_exec($curl);
            // curl_close($curl);

            // $info = "berhasil";

            // woo-wa.com
            $apikey = env('WA_KEY');

            $url='http://116.203.191.58/api/send_message';
                $data = array(
                    "phone_no"  => $phone,
                    "key"		=> $apikey,
                    "message"	=> $message,
                    "skip_link"	=> True // This optional for skip snapshot of link in message
                );
                $data_string = json_encode($data);

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_VERBOSE, 0);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
                curl_setopt($ch, CURLOPT_TIMEOUT, 360);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string))
                );
                echo $res=curl_exec($ch);
                curl_close($ch);

                // woo-wa.com kasir 6282155171933
        $phone   = '+6282155171933';
        $apikey = env('WA_KEY');
        $message =
            'Assalamualaikum Warohmatullahi Wabarokaatuh,
*Ini adalah pesan otomatis.*

Telah dikirimkan pembayaran Daftar Ulang & SPP Bulan Pertama dengan detail sebagai berikut :

Nama Peserta : '.$peserta->nama_peserta.'
NIS : '.$peserta->no_tahsin.'
Level/Kelas : '.$peserta->level_peserta.' / '.$peserta->jadwal_tahsin.'
Pengajar : '.$peserta->nama_pengajar.'
Nominal SPP : '.$pembayaran->nominal_pembayaran.'
Keterangan : Daftar Ulang & SPP Bulan Pertama
Kontak : wa.me/62'.$peserta->nohp_peserta.'

Klik link berikut untuk memeriksa riwayat pembayaran
https://atthala.arrahmahbalikpapan.or.id/admin/tahsin/daftar-ulang?nama='.str_replace(' ', '+', $peserta->nama_peserta);

        $url='http://116.203.191.58/api/send_message';
        $data = array(
            "phone_no"  => $phone,
            "key"		=> $apikey,
            "message"	=> $message,
            "skip_link"	=> True // This optional for skip snapshot of link in message
        );
        $data_string = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 360);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );
        echo $res=curl_exec($ch);
        curl_close($ch);


        } catch (\Throwable $th) {
            $info      = "gagal";
            $no_tahsin = "null";
        }
        return redirect()->to('/tahsin/daftar-ulang-peserta-XX/print?id='.$pesertadaftarulang->no_tahsin.'&nama='.$pesertadaftarulang->nama_peserta);

        // return redirect()->route('frontend.tahsin.printcalonpesertaujian', ['id' => $uuid]);
    }

    public function printdaftarulangpeserta(Request $request)
    {
        $data = Tahsin::where('no_tahsin', $request->get('id'))
                        ->where('nama_peserta', $request->get('nama'))
                        // ->where('id', $request->get('idt'))
                        ->where('angkatan_peserta', session('angkatan_tahsin'))
                        ->first();

        $pdf = PDF::loadView('frontend.tahsin.print-daftarulangpeserta', $data)->setPaper('a5', 'landscape');

        return $pdf->stream($data->nama_peserta.' - Kartu Daftar Ulang Tahsin LTTQ Arrahmah Balikpapan.pdf');
    }

    public function daftarcalonpeserta(Request $request)
    {
        $sesidaftar = Str::random(10);
        Session::put('sesidaftar', $sesidaftar);

        $notahsin            = $request->get('id');
        $angkatandaftarulang = session('angkatan_tahsin');

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
                    // ->where('jumlah_peserta', '<', 10)
                    ->select('hari_jadwal')
                    ->groupBy('hari_jadwal')
                    ->get();

        return view('frontend.tahsin.daftarcalonpeserta', compact('calonpeserta', 'cekterdaftar', 'hari'));
    }

    public function daftarcalonpesertawaktu(Request $request)
    {
        // $notahsin            = $request->get('id');
        // // $angkatandaftarulang = session('daftar_ulang_angkatan_tahsin');
        // $angkatandaftarulang = 18;
        // $jadwalhari          = $request->get('hari');

        // $calonpeserta = Tahsin::where('id', $request->get('idt'))
        //                     ->first();

        // $waktu['data'] = Jadwal::where('angkatan_jadwal', $angkatandaftarulang)
        //                     ->where('jenis_jadwal', $calonpeserta->jenis_peserta)
        //                     ->where('level_jadwal', $calonpeserta->level_peserta)
        //                     ->where('jumlah_peserta', '<', 10)
        //                     ->where('hari_jadwal', $jadwalhari)
        //                     ->get();

        $id           = $request->get('id');
        // $angkatan            = session('angkatan_tahsin');
        // $angkatandaftarulang = session('daftar_ulang_angkatan_tahsin');
        $angkatan            = session('angkatan_tahsin');
        $angkatandaftarulang = session('angkatan_tahsin');
        $jadwalhari          = $request->get('hari');

        $calonpeserta = Tahsin::where('id', $id)
                            ->first();

        //cek banyak data jam sesuai level
        $ceklevel = Jadwal::where('angkatan_jadwal', $angkatandaftarulang)
                    ->where('jenis_jadwal', $calonpeserta->jenis_peserta)
                    ->where('level_jadwal', $calonpeserta->level_peserta)
                    ->where('hari_jadwal', $request->get('hari'))
                    ->orderBy('waktu_jadwal', 'ASC')
                    ->get();

        // $waktu_[] = ['waktu_jadwal' => '-----', 'id' => ''];
        // dd($ceklevel);
        foreach ($ceklevel as $level) {
            $cekbanyakpeserta = null; // loop reset data variabel
            $cekbanyakpeserta = Tahsin::where('level_peserta', $level->level_jadwal)
                                ->where('jadwal_tahsin', $level->hari_jadwal.' '.$level->waktu_jadwal)
                                ->where('angkatan_peserta', $angkatandaftarulang)
                                ->where('nama_pengajar', $level->pengajar_jadwal)
                                ->where('jenis_peserta', $level->jenis_jadwal)
                                ->count();
            if ($cekbanyakpeserta == null) {
                $cekbanyakpeserta = 0;
            }

            if ($cekbanyakpeserta < $level->jumlah_peserta) {
                $waktu_[] = ['waktu_jadwal' => $level->waktu_jadwal, 'id' => $level->id, 'status' => ''];
            } else {
                $waktu_[] = ['waktu_jadwal' => 'Maaf Jadwal Penuh', 'id' => '', 'status' => 'disabled'];
            }

            // $waktu_[] = ['waktu_jadwal_' => $level->waktu_jadwal, 'id_' => $level->id, 'status_' => $cekbanyakpeserta];

        }
        // $waktu = collect($waktu_)->get();
        $waktu = collect($waktu_)->values();

        // $waktuu['data'] = Jadwal::where('angkatan_jadwal', $angkatandaftarulang)
        //                     ->where('jenis_jadwal', $calonpeserta->jenis_peserta)
        //                     ->where('level_jadwal', $calonpeserta->level_peserta)
        //                     ->where('hari_jadwal', $jadwalhari)
        //                     ->get();

        return response()->json($waktu);
    }

    public function simpandaftarcalonpeserta(Request $request)
    {
        $angkatan = session('angkatan_tahsin');

        // $this->validate($request, [
        //     'notelp'           => 'required',
        // ]);

        $cekterdaftarpeserta = Tahsin::where('no_tahsin', $request->input('id'))->whereNotNull('jadwal_tahsin')->where('angkatan_peserta', $angkatan)->first();

        if(isset($cekterdaftarpeserta)){
            return redirect()->to('/tahsin/pendaftaran/peserta?id='.$cekterdaftarpeserta->no_tahsin);
        }

        $pesertadaftar = Tahsin::where('no_tahsin', $request->input('id'))->where('angkatan_peserta', $angkatan)->first();

        // $datajadwal = Jadwal::where('angkatan_jadwal', $angkatan)
        //                 ->where('jenis_jadwal', $pesertadaftar->jenis_peserta)
        //                 ->where('hari_jadwal', $request->get('hari'))
        //                 ->where('waktu_jadwal', $request->get('waktu'))
        //                 ->where('level_jadwal', $pesertadaftar->level_peserta)
        //                 ->where('jumlah_peserta', '<', 10)
        //                 ->first();

        $datajadwal = Jadwal::where('id', $request->get('waktu'))->first();


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
                        'jadwal_tahsin'        => $datajadwal->hari_jadwal.' '.$datajadwal->waktu_jadwal,
            ]);

            // $tambahpeserta = Jadwal::where('id',  $datajadwal->id)
            //         ->update([
            //             'jumlah_peserta' => $datajadwal->jumlah_peserta + 1,
            //         ]);

            $phone = '+62'. $nohp;
            $message =
                "Assalamualaikum Warrohmarullah Wabarokatuh

Terima kasih, Anda telah terverifikasi oleh Sistem Atthala sebagai Peserta Tahsin Angkatan ".session('angkatan_tahsin')." LTTQ Ar Rahmah Balikpapan.

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
Panitia Pendaftaran Baru Tahsin Angkatan ".session('angkatan_tahsin')."
*Lembaga Tahsin Tahfizhil Qur'an (LTTQ) Ar Rahmah Balikpapan*";

        $apikey = env('WA_KEY');

        $url='http://116.203.191.58/api/send_message';
            $data = array(
                "phone_no"  => $phone,
                "key"		=> $apikey,
                "message"	=> $message,
                "skip_link"	=> True // This optional for skip snapshot of link in message
            );
            $data_string = json_encode($data);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_VERBOSE, 0);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 360);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
            );
            echo $res=curl_exec($ch);
            curl_close($ch);


        // } catch (\Throwable $th) {
        //     $info      = "gagal";
        //     $no_tahsin = "null";
        // }
        return redirect()->to('/tahsin/pendaftaran/print?id='.$request->get('id'));

        // return redirect()->route('frontend.tahsin.printcalonpesertaujian', ['id' => $uuid]);
    }

    public function printdaftarpeserta(Request $request)
    {
        $data = Tahsin::where('no_tahsin', $request->get('id'))->where('angkatan_peserta', session('angkatan_tahsin'))->first();

        $pdf = PDF::loadView('frontend.tahsin.print-daftarpeserta', $data)->setPaper('a5', 'landscape');

        return $pdf->stream($data->nama_peserta.' - Kartu Pendaftaran Tahsin LTTQ Arrahmah Balikpapan.pdf');
    }

    public function pembayarancari(Request $request)
    {
        if (!empty(request('namapeserta'))) {
            $pencarian = DB::table('tahsins')
                ->where('nama_peserta', 'like', '%' . request('namapeserta') . '%')
                ->where('level_peserta', '=', request('level'))
                ->where('nama_pengajar', '=', request('pengajar'))
                ->where('angkatan_peserta', '=', session('angkatan_tahsin'))
                ->paginate(15);
        } else {
            $pencarian = null;
        }
        $datapengajars = DB::table('tahsins')
            ->select('nama_pengajar')
            ->groupBy('nama_pengajar')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY nama_pengajar ASC'))
            ->where('angkatan_peserta', '=', session('angkatan_tahsin'))
            ->get();

        $datalevel = DB::table('tahsins')
            ->select('level_peserta')
            ->groupBy('level_peserta')
            ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY level_peserta ASC'))
            ->where('angkatan_peserta', '=', session('angkatan_tahsin'))
            ->get();

        return view('frontend.tahsin.cari-pembayaran', compact('datapengajars', 'datalevel', 'pencarian'));
    }

    public function pembayaran(Request $request)
    {
        $sesibayar = session('angkatan_tahsin').'-SPP-'.request()->idt.'-'.request()->id.'-'.\Str::random(5);
        Session::put('sesibayar', $sesibayar);

        // ngambil data profile
        $peserta = Tahsin::find(request()->id);
        return view('frontend.tahsin.pembayaran', compact('sesibayar', 'peserta'));
    }

    public function pembayaransimpan()
    {
        $pesertadaftar = Tahsin::find(request()->id);

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

        $pembayaran                            = new Pembayaran;
        $pembayaran->id_peserta                = request()->id;
        $pembayaran->nominal_pembayaran        = request()->nominaltf;
        $pembayaran->jenis_pembayaran          = 'SPP TAHSIN';
        $pembayaran->admin_pembayaran          = 'MENUNGGU KONFIRMASI';
        $pembayaran->bukti_transfer_pembayaran = Session::get('filebuktitransferspp');
        $pembayaran->keterangan_pembayaran     = collect(request()->pembayaran)->implode('-');
        $pembayaran->save();
        Session::put('id', $pembayaran->id);
        // dd($pembayaran);

        $phone = '+62'. $nohp;
        $message =
                "Assalamualaikum Warrohmarullah Wabarokatuh

*Ini adalah balasan otomatis.*
Terima kasih telah melakukan pembayaran Tahsin. Kasir kami akan memverifikasi pembayaran Bapak/Ibu/Saudara/i sekalian.

Berita terkini :
LTTQ Ar Rahmah Balikpapan sedang melakukan penggalangan dana untuk pembelian Gedung Belajar Al Qur’an Bersama. Donasi terkumpul saat ini adalah Rp 143.440.017 dari total kebutuhan 4 Milyar Rupiah. Gabung bersama kami untuk tetap mendapatkan amal jariyah dari ratusan santri-santri yang menghafalkan Kitabullah disini.

Transfer ke rekening Bank Syariah Indonesia 455-00000-60 a.n. Yayasan Ar Rahmah Balikpapan. Konfirmasi donasi ke wa.me/6281549225157.
Jazaakumullahu Khoiron

“Perumpamaan (nafkah yang dikeluarkan oleh) orang-orang yang menafkahkan hartanya di jalan Allah adalah serupa dengan sebutir benih yang menumbuhkan tujuh bulir, pada tiap-tiap bulir seratus biji. Allah melipat gandakan (ganjaran) bagi siapa yang Dia kehendaki. Dan Allah Maha Luas (karunia-Nya) lagi Maha Mengetahui.”
"
;

        $apikey = env('WA_KEY');

        $url='http://116.203.191.58/api/send_message';
        $data = array(
            "phone_no"  => $phone,
            "key"		=> $apikey,
            "message"	=> $message,
            "skip_link"	=> True // This optional for skip snapshot of link in message
        );
        $data_string = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 360);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );
        echo $res=curl_exec($ch);
        curl_close($ch);

        $data = Pembayaran::find(Session::get('id'));
        $phone = '+6282155171933';

        // woo-wa.com kasir
        $apikey = env('WA_KEY');
        $message =
            'Assalamualaikum Warohmatullahi Wabarokaatuh,
*Ini adalah pesan otomatis.*

Telah dikirimkan pembayaran SPP dengan detail sebagai berikut :

Nama Peserta : '.$data->tahsin->nama_peserta.'
NIS : '.$data->tahsin->no_tahsin.'
Level/Kelas : '.$data->tahsin->level_peserta.' / '.$data->tahsin->jadwal_tahsin.'
Pengajar : '.$data->tahsin->nama_pengajar.'
Nominal SPP : '.$data->nominal_pembayaran.'
Keterangan : Pembayaran SPP Bulan Ke '.$data->keterangan_pembayaran.'
Kontak : wa.me/62'.$data->tahsin->nohp_peserta.'

Klik link berikut untuk memeriksa riwayat pembayaran
https://atthala.arrahmahbalikpapan.or.id/admin/tahsin/pembayaran?id='.$data->id.'
';

        $url='http://116.203.191.58/api/send_message';
        $data = array(
            "phone_no"  => $phone,
            "key"		=> $apikey,
            "message"	=> $message,
            "skip_link"	=> True // This optional for skip snapshot of link in message
        );
        $data_string = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 360);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );
        echo $res=curl_exec($ch);
        curl_close($ch);

        return redirect()->route('frontend.tahsin.pembayaranselesai');

    }
    public function uploadbuktitransferspp(Request $request)
    {
        if ($_SERVER['HTTP_HOST'] == 'atthala.arrahmahbalikpapan.or.id') {
            $file_bukti_transfer      = $request->file('filepond');
            $nama_file_bukti_transfer = Session::get('sesibayar').'.'.$file_bukti_transfer->getClientOriginalExtension();
            Session::put('filebuktitransferspp', $nama_file_bukti_transfer); //membuat sesi nama file agar sesuai dengan pemilik pendaftar
            // Storage::disk('bukti-transfer-atthala')->put($nama_file_bukti_transfer, File::get($file_bukti_transfer));

            $buktitf         = Image::make($file_bukti_transfer);
            $lokasibuktitf   = public_path('../../../public_html/atthala/bukti-transfer-spp/');
            $buktitf->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $buktitf->save($lokasibuktitf.$nama_file_bukti_transfer);
        } else {
            $file_bukti_transfer      = $request->file('filepond');
            $nama_file_bukti_transfer = Session::get('sesibayar').'.'.$file_bukti_transfer->getClientOriginalExtension();
            Session::put('filebuktitransferspp', $nama_file_bukti_transfer); //membuat sesi nama file agar sesuai dengan pemilik pendaftar
            // Storage::disk('bukti-transfer')->put($nama_file_bukti_transfer, File::get($file_bukti_transfer));

            $buktitf         = Image::make($file_bukti_transfer);
            $lokasibuktitf   = public_path('bukti-transfer-spp/');
            $buktitf->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $buktitf->save($lokasibuktitf.$nama_file_bukti_transfer);
        }

    }

    public function pembayaranselesai()
    {
        $info = request()->info ?? 'berhasil';

        return view('frontend.tahsin.pembayaran-selesai', compact('info'));
    }
}
