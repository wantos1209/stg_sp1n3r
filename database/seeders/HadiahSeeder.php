<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HadiahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hadiah')->insert([
            ['id' => 1, 'hadiah' => 2000, 'persentase' => 30, 'created_at' => null, 'updated_at' => Carbon::parse('2023-12-13 04:01:36')],
            ['id' => 2, 'hadiah' => 5000, 'persentase' => 37, 'created_at' => null, 'updated_at' => Carbon::parse('2023-12-13 04:01:44')],
            ['id' => 3, 'hadiah' => 10000, 'persentase' => 30, 'created_at' => null, 'updated_at' => Carbon::parse('2023-12-13 04:01:50')],
            ['id' => 13, 'hadiah' => 0, 'persentase' => 20, 'created_at' => null, 'updated_at' => null],
            ['id' => 14, 'hadiah' => 100000, 'persentase' => 2, 'created_at' => null, 'updated_at' => null],
            ['id' => 15, 'hadiah' => 10000000, 'persentase' => 0, 'created_at' => null, 'updated_at' => null],
        ]);
    }
}
