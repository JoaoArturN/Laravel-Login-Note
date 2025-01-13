<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notes')->insert([

            [
                'title' => 'Teste',
                'user_id' => 1,
                'text' => 'Estou testando',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Teste 2',
                'user_id' => 1,
                'text' => 'Estou testando 2',
                'created_at' => date('Y-m-d H:i:s'),
            ],

        ]);
    }
}
