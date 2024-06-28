<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeteranganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('keterangan')->insert([
            [
                'id' => 1,
                'keterangan' => 'BONUS FREESPIN',
                'created_at' => Carbon::parse('2024-01-23 02:51:06'),
                'updated_at' => Carbon::parse('2024-01-23 02:54:43'),
            ],
            [
                'id' => 2,
                'keterangan' => 'BONUS APK',
                'created_at' => Carbon::parse('2024-01-23 02:54:51'),
                'updated_at' => Carbon::parse('2024-01-23 02:54:51'),
            ],
            [
                'id' => 3,
                'keterangan' => 'BONUS PEMILU',
                'created_at' => Carbon::parse('2024-01-23 02:55:00'),
                'updated_at' => Carbon::parse('2024-01-23 02:55:00'),
            ],
            [
                'id' => 6,
                'keterangan' => 'BONUS TELEGRAM',
                'created_at' => Carbon::parse('2024-02-01 10:28:01'),
                'updated_at' => Carbon::parse('2024-02-01 10:28:01'),
            ],
        ]);
    }
}
