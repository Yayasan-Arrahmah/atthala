<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Tahsin;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;


class TahsinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.tahsin.pendaftaran');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function pendaftaran(Request $request)
    {
        return view('frontend.tahsin.pendaftaran');
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'nama_peserta'           => 'required',
            'nohp_peserta'           => 'required',
            'jenis_peserta'          => 'required',
            'fotoktp_peserta'        => 'required|file|image|mimes:jpg,jpeg,png,gif,webp|max:30720',
            'rekaman_peserta'        => 'required|file|max:20480',
            'bukti_transfer_peserta' => 'required|file|image|mimes:jpg,jpeg,png,gif,webp|max:30720'
        ]);

        $tahsin     = new Tahsin;
        $pembayaran = new Pembayaran;

        //angkatan 16. masih tulis manual blum dinamis seting angkatan
        $banyakid   = Tahsin::where('angkatan_peserta', 16)->count();
        $generateid = $banyakid + 1;

        try {

            if ($request->jenis_peserta == "IKHWAN") {
                $pilih_jadwal_peserta            = $request->pilih_jadwal_peserta;
                $pilih_jadwal_cadangan_1_peserta = $request->pilih_jadwal_cadangan_1_peserta;
                $pilih_jadwal_cadangan_2_peserta = $request->pilih_jadwal_cadangan_2_peserta;
                $jenisid = "TI";
            } elseif ($request->jenis_peserta == "AKHWAT") {
                $pilih_jadwal_peserta            = $request->pilih_jadwal_peserta_hari . ' ' . $request->pilih_jadwal_peserta_jam;
                $pilih_jadwal_cadangan_1_peserta = $request->pilih_jadwal_cadangan_1_peserta_hari . ' ' . $request->pilih_jadwal_cadangan_1_peserta_jam;
                $pilih_jadwal_cadangan_2_peserta = $request->pilih_jadwal_cadangan_2_peserta_hari . ' ' . $request->pilih_jadwal_cadangan_2_peserta_jam;
                $jenisid = "TA";
            }

            $no_tahsin  = $jenisid . '-16-' . str_pad($generateid, 4, '0', STR_PAD_LEFT);

            $nominal_pembayaran = 200000 + ($request->has('bayar_modul') === true ? 60000 : 0) + ($request->has('bayar_mushaf') === true ? 110000 : 0);
            $waktu_lahir_peserta = $request->tanggal_lahir . '-' . $request->bulan_lahir . '-' . $request->tahun_lahir;

            //upload ktp
            $file_ktp      = $request->file('fotoktp_peserta');
            $nama_file_ktp = $no_tahsin . ' ' . \Carbon\Carbon::now()->format('Y-m-d H:i:s') . '-KTP';
            $extension_ktp = $file_ktp->getClientOriginalExtension();
            Storage::disk('ktp')->put($nama_file_ktp . '.' . $extension_ktp,  File::get($file_ktp));

            //upload rekaman
            $file_rekaman      = $request->file('rekaman_peserta');
            $nama_file_rekaman = $no_tahsin . ' ' . \Carbon\Carbon::now()->format('Y-m-d H:i:s') . '-REKAMAN';
            $extension_rekaman = $file_rekaman->getClientOriginalExtension();
            Storage::disk('rekaman')->put($nama_file_rekaman . '.' . $extension_rekaman,  File::get($file_rekaman));

            //upload bukti transfer
            $file_buktitf      = $request->file('bukti_transfer_peserta');
            $nama_file_buktitf = $no_tahsin . ' ' . \Carbon\Carbon::now()->format('Y-m-d H:i:s') . '-BUKTI-RANSFER';
            $extension_buktitf = $file_buktitf->getClientOriginalExtension();
            Storage::disk('bukti-transfer')->put($nama_file_buktitf . '.' . $extension_buktitf,  File::get($file_buktitf));

            $tahsin->no_tahsin                       = $no_tahsin;
            $tahsin->nama_peserta                    = $request->nama_peserta;
            $tahsin->nohp_peserta                    = $request->nohp_peserta;
            $tahsin->jenis_peserta                   = $request->jenis_peserta;
            $tahsin->angkatan_peserta                   = "16";
            $tahsin->alamat_peserta                  = $request->alamat_peserta;
            $tahsin->pekerjaan_peserta               = $request->pekerjaan_peserta;
            $tahsin->tempat_lahir_peserta            = $request->tempat_lahir_peserta;
            $tahsin->waktu_lahir_peserta             = $waktu_lahir_peserta;
            $tahsin->pilih_jadwal_peserta            = $pilih_jadwal_peserta;
            $tahsin->pilih_jadwal_cadangan_1_peserta = $pilih_jadwal_cadangan_1_peserta;
            $tahsin->pilih_jadwal_cadangan_2_peserta = $pilih_jadwal_cadangan_2_peserta;
            $tahsin->fotoktp_peserta                 = $nama_file_ktp . '.' . $extension_ktp;
            $tahsin->rekaman_peserta                 = $nama_file_rekaman . '.' . $extension_rekaman;
            $tahsin->save();

            $pembayaran->id_peserta                = $no_tahsin;
            $pembayaran->nominal_pembayaran        = $nominal_pembayaran;
            $pembayaran->jenis_pembayaran          = "TAHSIN";
            $pembayaran->admin_pembayaran          = "TRANSFER";
            $pembayaran->bukti_transfer_pembayaran = $nama_file_buktitf . '.' . $extension_buktitf;
            $pembayaran->save();

            $info = "berhasil";
        } catch (\Throwable $th) {
            $info      = "gagal";
            $no_tahsin = "null";
        }
        return redirect()->route('frontend.tahsin.selesai', ['info'=>$info,'id'=>$no_tahsin]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function selesai(Request $request)
    {
        $info      = $request->info;
        $id        = $request->id;
        return view('frontend.tahsin.pendaftaran-selesai', compact('info','id'));
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
}