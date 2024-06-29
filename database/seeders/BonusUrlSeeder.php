<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BonusUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bonus_url')->insert([
            [
                'id' => 1,
                'url' => 'https://pilih21.l21paito.net/l21pemilu/',
                'created_at' => null,
                'updated_at' => '2024-02-03 04:09:06',
                'banner_url' => 'https://sinarperak.b-cdn.net/idn_l21_design_new1/gambar/promo-pemilu.png',
            ],
            [
                'id' => 4,
                'url' => 'https://vpncepat.org/',
                'created_at' => '2024-01-21 09:19:30',
                'updated_at' => '2024-01-25 06:59:28',
                'banner_url' => 'https://sinarperak.b-cdn.net/content_site/promo_2023/promospinner.jpg',
            ],
        ]);
    }
}
