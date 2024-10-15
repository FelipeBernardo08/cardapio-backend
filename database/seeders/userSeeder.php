<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'adm@gmail.com',
            'password' => bcrypt('123'),
            'fk_userType' => 1,
            'active' => true
        ]);
    }
}
