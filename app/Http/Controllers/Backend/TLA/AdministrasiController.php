<?php

namespace App\Http\Controllers\Backend\Tahsin;

use App\Http\Controllers\Controller;
use App\Models\Tahsin;
use DB;

class AdministrasiController extends Controller
{
    public function __construct()
    {
        $this->id            = request()->id ?? null;
        $this->nama          = request()->nama ?? null;
        $this->kenaikanlevel = request()->kenaikanlevel ?? null;
        $this->idtahsin      = request()->idtahsin ?? null;
        $this->level         = request()->level ?? null;
        $this->nohp          = request()->nohp ?? null;
        $this->jenis         = request()->jenis ?? null;
        $this->pengajar      = request()->pengajar ?? null;
        $this->angkatan      = request()->angkatan ?? 19;
        // $this->angkatanbaru  = request()->angkatan ?? 19;
        // $this->angkatanujian = request()->angkatan ?? 18;
        $this->status        = request()->status ?? null;
    }

    public function peserta()
    {
        $tahsins = Tahsin::cariNama($this->nama)
                        ->cariLevel($this->level)
                        ->jenis($this->jenis)
                        ->angkatan($this->angkatan)
                        ->pengajar($this->pengajar)
                        ->statusPeserta($this->status)
                        ->paginate(10);

        $datapengajars = Tahsin::select('nama_pengajar', 'jenis_peserta', (DB::raw('COUNT(*) as jumlah ')))
                        ->groupBy('nama_pengajar', 'jenis_peserta')
                        ->havingRaw(DB::raw('COUNT(*) > 0 ORDER BY nama_pengajar ASC'))
                        ->get();

        if(isset($this->kenaikanlevel)){
            $updatelevel = Tahsin::where('id', $this->id)
                         ->update(['kenaikan_level_peserta' => $this->kenaikanlevel]);
            return redirect()->back()->withFlashSuccess($this->idtahsin.' Berhasil Diperbaruhi');
        }

        return view('backend.tahsin-v2.peserta', compact('tahsins', 'datapengajars'));
    }

    public function getOkeMantap()
    {
        $oke = 'oke';
        return $oke;
    }
}
