<?php

use Illuminate\Database\Seeder;

use App\Pengaturan;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengaturan::create([
            'gambar'        => 'logo.jpg',
            'nama'          => 'CBT',
            'deskripsi'     => 'Computer Based Test Politeknik Kesehatan Denpasar'
        ]);
    }
}
