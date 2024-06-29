<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FloatingimageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('floatingimage')->insert([
            [
                'id' => 1,
                'url' => 'https://sinarperak.b-cdn.net/idn_l21_design_new1/gambar/GIFPEMILUSTICKY_1.gif',
                'created_at' => NULL,
                'updated_at' => '2024-01-18 05:47:56',
            ],
            [
                'id' => 2,
                'url' => 'https://i.pinimg.com/originals/88/fb/60/88fb60ec556886275ae280857f321e46.gif',
                'created_at' => '2024-01-21 08:37:31',
                'updated_at' => '2024-01-21 09:43:37',
            ],
        ]);
    }
}
