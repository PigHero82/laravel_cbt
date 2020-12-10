<?php

use App\ListRole;
use Illuminate\Database\Seeder;

class ListRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ListRole::insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);

        ListRole::insert([
            'user_id' => 2,
            'role_id' => 2,
        ]);

        ListRole::insert([
            'user_id' => 3,
            'role_id' => 3,
        ]);
    }
}
