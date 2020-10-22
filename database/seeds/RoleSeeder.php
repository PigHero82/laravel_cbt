<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'          => 'admin',
            'description'   => 'Administrator'
        ]);

        Role::create([
            'name'          => 'dosen',
            'description'   => 'Dosen'
        ]);

        Role::create([
            'name'          => 'mahasiswa',
            'description'   => 'Mahasiswa'
        ]);
    }
}
