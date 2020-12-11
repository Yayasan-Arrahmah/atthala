<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rtq;
use App\Models\RtqRapor;
use App\Models\RtqPeriodeRapor;
use Illuminate\Support\Str;
use App\Models\RtqPenilaian;
use App\Models\RtqKategoriPenilaian;
use App\Models\RtqSubKategoriPenilaian;
use PDF;
use Carbon\Carbon;

class RtqRaporController extends Controller
{
    public function prosesrapor(Request $request)
    {

        $rapor  = RtqRapor::where('id_santri', $request->get('id'))
                            ->where('id_periode_rapor', $request->get('periode'))
                            ->first();

        if(isset($rapor)){
            return redirect()->route('admin.rtqs.rapor', ['uuid' => $rapor->uuid]);
        } else {
            $buatrapor    = new RtqRapor;
            $kategoris    = RtqKategoriPenilaian::get();
            $uuid         = Str::uuid();

            $buatrapor->uuid             = $uuid;
            $buatrapor->id_santri        = $request->get('id');
            $buatrapor->id_periode_rapor = $request->get('periode');
            $buatrapor->save();

            foreach($kategoris as $kategori){
                $subkategoris = RtqSubKategoriPenilaian::where('id_kategori', $kategori->id)->get();
                foreach($subkategoris as $subkategori){
                    $penilaian    = new RtqPenilaian;
                    $penilaian->id_rapor        = $buatrapor->id;
                    $penilaian->id_santri       = $request->get('id');
                    $penilaian->id_sub_kategori = $subkategori->id;
                    $penilaian->save();
                }
            }

            return redirect()->to('/admin/rtq/rapor?uuid='.$uuid);
        }
    }

    public function rapor(Request $request)
    {
        $kategoris  = RtqKategoriPenilaian::get();
        $rapor      = RtqRapor::where('uuid', $request->get('uuid'))->first();
        $santri     = Rtq::where('id', $rapor->id_santri)->first();
        if( request()->verifikasi == 'ya' ){
            $rapor->verifikasi_rapor = 'TERVERIFIKASI';
            $rapor->save();
            return view('backend.rtq.rapor', compact('santri', 'rapor', 'kategoris'))->withFlashSuccess('Berhasil Diverifikasi !');
        } else {
            return view('backend.rtq.rapor', compact('santri', 'rapor', 'kategoris'));
        }
    }

    public function raporupdate(Request $request)
    {
        $rapor  = RtqRapor::where('uuid', $request->get('uuid'))->first();

        $rapor->hafalan_santri            = $request->get('hafalan_santri') ?? null;
        $rapor->level_tahsin_santri       = $request->get('level_tahsin_santri') ?? null;
        $rapor->jumlah_hari_sakit         = $request->get('jumlah_hari_sakit') ?? null;
        $rapor->jumlah_hari_izin          = $request->get('jumlah_hari_izin') ?? null;
        $rapor->jumlah_hari_tanpa_ket     = $request->get('jumlah_hari_tanpa_ket') ?? null;
        $rapor->catatan_pembimbing_santri = $request->get('catatan_pembimbing_santri') ?? null;
        $rapor->save();

        $kategoris    = RtqKategoriPenilaian::get();
        foreach($kategoris as $kategori){
            $subkategoris = RtqSubKategoriPenilaian::where('id_kategori', $kategori->id)->get();
            foreach($subkategoris as $subkategori){
                $penilaian    = RtqPenilaian::where('id_rapor', $rapor->id)
                                            ->where('id_sub_kategori', $subkategori->id)
                                            ->first();
                $penilaian->nilai_santri   = strtoupper($request->get('nilai'.$penilaian->id)) ?? null;
                $penilaian->save();
            }
        }
        return redirect()->back()->withFlashSuccess('Berhasil Tersimpan !');
    }

    public function raporcetak(Request $request)
    {
        $data = RtqRapor::where('uuid', $request->get('uuid'))->first();
        $tanggal = Carbon::parse($data->created_at)->locale('id');

        $pdf = PDF::loadView('backend.rtq.rapor-cetak', compact('data', 'tanggal'))->setPaper('a4', 'potrait');
        $santri = Rtq::where('id', $data->id_santri)->first();
        return $pdf->stream($santri->nis.' - '.$santri->nama_santri.' - RTQ Arrahmah Balikpapan.pdf');
    }
}
