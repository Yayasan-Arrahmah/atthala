<?php

use Illuminate\Database\Seeder;
use App\Models\LevelTahsin;

class LevelTahsinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LevelTahsin::create([
                'nama' => 'ASAASI 1',
                'sort' => 1,
                'warna'=> '#20a8d8',
            ]);
        LevelTahsin::create([
                'nama' => 'ASAASI 2',
                'sort' => 2,
                'warna'=> '#20c997',
            ]);
        LevelTahsin::create([
                'nama' => 'TILAWAH ASAASI',
                'sort' => 3,
                'warna'=> '#17a2b8',
            ]);
        LevelTahsin::create([
                'nama' => 'TAMHIDI',
                'sort' => 4,
                'warna'=> '#ffc107',
            ]);
        LevelTahsin::create([
                'nama' => 'TAWASUTHI',
                'sort' => 5,
                'warna'=> '#6610f2',
            ]);
        LevelTahsin::create([
                'nama' => 'TILAWAH TAWASUTH',
                'sort' => 6,
                'warna'=> '#ffb700',
            ]);
        LevelTahsin::create([
                'nama' => 'IDADI',
                'sort' => 7,
                'warna'=> '#e83e8c',
            ]);
        LevelTahsin::create([
                'nama' => 'TAKMILI',
                'sort' => 8,
                'warna'=> '#4dbd74',
            ]);
        LevelTahsin::create([
                'nama' => 'TAHSINI',
                'sort' => 9,
                'warna'=> '#b51818',
            ]);
        LevelTahsin::create([
                'nama' => 'ITQON',
                'sort' => 10,
                'warna'=> '#1848f5',
            ]);

    }
}
