<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('users')->insert([

        [
            'username' => 'João Artur',
            'password' =>  bcrypt('123'),
            'created_at' => date('Y-m-d H:i:s')
        ],
        [
            'username' => 'João Artur 2',
            'password' =>  bcrypt('123'),
            'created_at' => date('Y-m-d H:i:s')
        ],

        ]);
    }
}
