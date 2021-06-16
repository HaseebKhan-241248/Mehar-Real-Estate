<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class Users_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'     => "Haseeb Khan",
            'email'    => "admin@demo.com",
            'role'     => "Super Admin",
            'password' => bcrypt('12345678')
        ]);
         User::create([
            'name'     => "GM",
            'email'    => "gm@demo.com",
            'role'     => "GM",
            'password' => bcrypt('12345678')
        ]);
    }
}
