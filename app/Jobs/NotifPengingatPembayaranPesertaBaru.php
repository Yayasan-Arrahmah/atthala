<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\Tahsin;

class NotifPengingatPembayaranPesertaBaru implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
     
    protected $pesertaId;
    public function __construct($pesertaId)
    {
        $this->pesertaId = $pesertaId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $peserta = Tahsin::find($this->pesertaId);
        if ($peserta) {
        $namaPeserta = str_replace(' ', '+', $peserta->nama_peserta);
        $levelPeserta = str_replace(' ', '+', $peserta->level_peserta);
        $namaPengajar = str_replace(' ', '+', $peserta->nama_pengajar);

        $pesan = "Assalamu'alaikum warahmatullahi bapak/ibu peserta Tahsin Ar Rahmah, 
        
*INFO TAHSIN (Wajib Dibaca)*        
Mohon maaf, ada kendala teknis terkait sistem pembayaran.

Mohon cek kembali data (Riwayt SPP) Anda melalui link ini.
https://atthala.arrahmahbalikpapan.or.id/tahsin/pembayaran/cari?namapeserta=".$namaPeserta."&level=".$levelPeserta."&pengajar=".$namaPengajar."&angkatan=24

*Total Biaya Tahsin Peserta Baru :*
Biaya pendaftaran : Rp. 100.000
Total SPP 4 Bulan / 1 Periode: Rp. 400.000
Total Biaya Periode Angkatan ini : Rp. 500.000

Note:
Apabila terjadi kesalahan data, silahkan melakukan pembayaran kembali dan upload bukti transfer Anda.

Syukron, Jazakumullah Khoiran

Tahsin LTTQ
Ar Rahmah Balikpapan";

        $apikey = env('WAHA_API_KEY');
        $url = env('WAHA_API_URL');
        $sessionApi = env('WAHA_API_SESSION');
        $requestApi = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'X-Api-Key' => $apikey,
        ]);
        
        // #2 Start Typing
        // $requestApi->post($url . '/api/startTyping', ["session" => $sessionApi, "chatId" => '62'.$peserta->nohp_peserta . '@c.us']);

        // sleep(1); // jeda seolah olah ngetik

        // #3 Stop Typing
        // $requestApi->post($url . '/api/stopTyping', ["session" => $sessionApi, "chatId" => '62'.$peserta->nohp_peserta . '@c.us']);

        // #4 Send Message
        // $requestApi->post($url . '/api/sendText', [
        //     "session" => $sessionApi,
        //     "chatId" => '62'.$peserta->nohp_peserta.'@c.us',
        //     "text" => $pesan,
        // ]);
        $requestApi->get($url.'/api/sendText', [
                "session" => $sessionApi,
                "phone"  => '62'.$peserta->nohp_peserta.'@c.us',
                "text"    => $pesan,
            ]);
        }
    }
}
