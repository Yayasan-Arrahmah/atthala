<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
// use Request;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use App\Models\Sembako;
use Illuminate\Support\Carbon;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.index');
    }

    public function pesertaTahsin(Request $request)
    {
        if (!empty(request('namapeserta'))) {
            $pencarian = DB::table('tahsins')
                ->where('nama_peserta', 'like', '%' . request('namapeserta') . '%')
                ->where('level_peserta', '=', request('level'))
                ->where('nama_pengajar', '=', request('pengajar'))
                ->paginate(10);
        } else {
            $pencarian = DB::table('tahsins')
                ->where('level_peserta', '=', 'xyz')
                ->paginate(10);
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

        return view('frontend.pencarian.peserta-tahsin', compact('datapengajars', 'datalevel', 'pencarian'));
    }

    public function sembako(Request $request)
    {
        $status = request('s') ?? '';
        return view('frontend.ekonomi.sembako', compact('status'));
    }

    public function sembakosimpan(Request $request)
    {
        try {

            $pesanan = [
                'beras'  => $request->input('beras'),
                'minyak' => $request->input('minyak'),
                'gula'   => $request->input('gula'),
                'telur'  => $request->input('telur')
            ];
            $total = ($request->input('beras') * 62000) + ($request->input('minyak') * 25000) + ($request->input('gula') * 14000) + ($request->input('telur') * 50000);

            $sembako = new Sembako;
            $sembako->nama    = $request->input('nama');
            $sembako->notelp  = $request->input('notelp');
            $sembako->status  = $request->input('status');
            $sembako->pesanan = json_encode($pesanan);
            $sembako->total = $total;
            // dd($sembako);
            $sembako->save();

            //             $apikey = 'gzUeDIPcqUzYRiupTR2wTRIUccaEizKs';
            //             $phone = '+62'. $request->input('notelp');
            //             $message =
            //                 'Assalamualaikum Warrohmarullah Wabarokatuh

            // Terima Kasih ' . $request->input('nama') . ' 😊🙏

            // Pemesanan sembako telah berhasil kami terima.
            // Dengan Rincian :
            // Beras Mawar 5 Kg = *' . $request->input('beras') . ' Paket*
            // Minyak SIFF 2 Ltr = *' . $request->input('minyak') . ' Paket*
            // Gula 1 Kg = *' . $request->input('gula') . ' Paket*
            // Telur 1 Piring = *' . $request->input('telur') . ' Paket*

            // Total : *Rp. ' . number_format($total, 0, ',', '.') . '*

            // pengambilan sembako dapat diambil :
            // Tanggal : 26-30 Setiap Bulannya.
            // Lokasi : Sepinggan Pratama, Blok D2 No. 10

            // Jazzakallah Khoiron Katsiron 🙂

            // Salam,

            // *Arrahmah Balikpapan*';

            //             $url = 'https://api.wanotif.id/v1/send';

            //             $curl = curl_init();
            //             curl_setopt($curl, CURLOPT_URL, $url);
            //             curl_setopt($curl, CURLOPT_HEADER, 0);
            //             curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            //             curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            //             curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            //             curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            //             curl_setopt($curl, CURLOPT_POST, 1);
            //             curl_setopt($curl, CURLOPT_POSTFIELDS, array(
            //                 'Apikey'    => $apikey,
            //                 'Phone'     => $phone,
            //                 'Message'   => $message,
            //             ));
            //             $response = curl_exec($curl);
            //             curl_close($curl);
            return redirect()->route('frontend.sembako', ['s' => 'selesai'])->withFlashSuccess($request->input('nama') . ', Pemesanan Sembako Berhasil !<br/> Terima kasih.');
        } catch (\Throwable $th) {
            return redirect()->back()->withFlashDanger($request->input('nama') . ', Terjadi Kesalahan. Mohon Diulangi !<br/>Terima kasih.');
        }
    }

    public function sembakodata(Request $request)
    {
        $bulan = $request->input('bulan') ?? null;
        $tahun = $request->input('tahun') ?? null;


        if ($bulan != null || $tahun != null) {
            $sembako = Sembako::whereMonth('created_at', '=', $bulan)->whereYear('created_at', '=', $tahun);
        } else {
            $sembako = null;
        }

        return view('frontend.ekonomi.sembako-data', compact('sembako'));
    }
}
