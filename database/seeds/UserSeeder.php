<?php

use App\Role;
use App\User;
use App\DataDiri;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Ida Bagus Kadek Darma Wiryatama, S.Kom.',
            'username'  => '12345678',
            'password'  => Hash::make('password123'),
        ])
            ->roles()
            ->attach(Role::where('name', 'admin')->first());

        DataDiri::create([
            'idUser'    => 1
        ]);
    }
}
