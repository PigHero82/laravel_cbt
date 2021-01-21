<?php

use Illuminate\Database\Seeder;

use App\Prodi;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prodi::create([
            'nama' => 'Teknik Informatika'
        ]);
    }
}
