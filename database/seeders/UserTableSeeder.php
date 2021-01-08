<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'joke',
            'email' => rand(1,10).'@gmail.com',
            'password' => md5('123456'),
            'nickname'=>'xxx',
            'status'=>1,
        ]);
    }
}
