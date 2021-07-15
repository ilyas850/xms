<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin XMS',
            'username' => 'admin-xms',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => '1',
            'created_at' => \Carbon\Carbon::now(),
            'email_verified_at' => \Carbon\Carbon::now()
        ]);
        DB::table('users')->insert([
            'name' => 'Psikolog',
            'username' => 'psikolog-xms',
            'email' => 'psikolog@gmail.com',
            'password' => Hash::make('user123'),
            'role' => '2',
            'created_at' => \Carbon\Carbon::now(),
            'email_verified_at' => \Carbon\Carbon::now()
        ]);
    }
}
