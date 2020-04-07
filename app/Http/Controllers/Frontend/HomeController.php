<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Request;

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
        if ( !empty(request('namapeserta')) ) {
            $pencarian = DB::table('tahsins')
                    ->where('nama_peserta', 'like', '%'.request('namapeserta').'%')
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

        return view('frontend.pencarian.peserta-tahsin', compact('datapengajars', 'pencarian'));
    }
}
