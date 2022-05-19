<?php

use Illuminate\Database\Seeder;
use App\Models\StatusPesertaTahsin;

class PesertaTahsinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusPesertaTahsin::create(
            ['nama' => 'UMUM'],
        );
        StatusPesertaTahsin::create(
            ['nama' => 'LAZIZ'],
        );
        StatusPesertaTahsin::create(
            ['nama' => 'KARYAWAN'],
        );
    }
}
