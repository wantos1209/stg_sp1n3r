<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListPrizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('list_prize')->insert([
            [
                'id' => 1,
                'nama' => 'Motor Yamaha NMAX',
                'unit' => 1,
                'created_at' => '2023-12-12 06:17:31',
                'updated_at' => '2023-12-13 03:14:38'
            ],
            [
                'id' => 2,
                'nama' => 'Motor Honda VARIO',
                'unit' => 2,
                'created_at' => '2023-12-12 06:17:52',
                'updated_at' => '2023-12-13 03:14:44'
            ],
            [
                'id' => 3,
                'nama' => 'Laptop ASUS VivoBook 14inch',
                'unit' => 5,
                'created_at' => '2023-12-12 06:18:02',
                'updated_at' => '2023-12-13 03:14:52'
            ],
            [
                'id' => 4,
                'nama' => 'HP Samsung A32 Ram 8GB',
                'unit' => 10,
                'created_at' => '2023-12-12 06:18:08',
                'updated_at' => '2023-12-13 03:15:01'
            ],
            [
                'id' => 5,
                'nama' => 'Toshiba LED TV - HD Smart TV 32 inch',
                'unit' => 10,
                'created_at' => '2023-12-12 06:25:39',
                'updated_at' => '2023-12-13 03:15:08'
            ],
            [
                'id' => 6,
                'nama' => 'Mega Voucher',
                'unit' => 20,
                'created_at' => '2023-12-12 06:25:58',
                'updated_at' => '2023-12-13 03:15:16'
            ],
        ]);
    }
}
