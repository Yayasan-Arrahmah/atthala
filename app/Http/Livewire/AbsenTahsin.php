<?php

namespace App\Http\Livewire;

use App\Models\Absen;
use App\Models\Tahsin;
use Livewire\Component;

class AbsenTahsin extends Component
{
    public $keteranganabsen = null;

    public function absensi($ke)
    {
        $absen = new Absen;

        $cekabsen = $absen->where('id_peserta', 2)->where('user_create_absen', auth()->user()->id)->first();
        if (isset($ceknilai)) {
            $cekabsen->update([
                'status_praktikum_nilai' => $this->keteranganabsen,
            ]);
        } else {
            $absen->create([
                'id_peserta'             => '1',
                'user_create_absen'      => auth()->user()->id,
                'pertemuan_ke_absen'     => $ke,
                'jenis_absen'            => 'TAHSIN',
                'angkatan_absen'         => '16',
                'status_praktikum_nilai' => $this->keteranganabsen,
            ]);
        }
    }

    // public function mount($id)
    // {
    //     $this->post = Absen::where('id_peserta', 2)->where('user_create_absen', auth()->user()->id)->first();
    // }

    public function render()
    {
        return view(
            'livewire.absen-tahsin',
            [
                'tahsins' => Tahsin::where('angkatan_tahsin', '16')
                    ->where('pengajar', auth()->user()->email),
            ]
        );
    }
}
