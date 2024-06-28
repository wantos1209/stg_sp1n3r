<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpinnerJenisVoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('spinner_jenisvoucher')->insert([
            ['id' => 2, 'nama' => '100.000', 'created_at' => Carbon::parse('2023-05-20 00:57:52'), 'updated_at' => Carbon::parse('2023-06-11 07:12:14'), 'index' => 12, 'saldo_point' => 100000, 'hadiah' => null],
            ['id' => 3, 'nama' => 'ZONK', 'created_at' => Carbon::parse('2023-05-20 00:57:59'), 'updated_at' => Carbon::parse('2023-06-11 07:11:57'), 'index' => 11, 'saldo_point' => 0, 'hadiah' => null],
            ['id' => 5, 'nama' => '2.000', 'created_at' => Carbon::parse('2023-05-20 01:07:42'), 'updated_at' => Carbon::parse('2023-06-11 07:11:47'), 'index' => 10, 'saldo_point' => 2000, 'hadiah' => null],
            ['id' => 6, 'nama' => '350.000', 'created_at' => Carbon::parse('2023-05-20 01:10:29'), 'updated_at' => Carbon::parse('2023-06-11 07:11:32'), 'index' => 9, 'saldo_point' => 350000, 'hadiah' => null],
            ['id' => 13, 'nama' => '5.000', 'created_at' => Carbon::parse('2023-05-20 01:18:20'), 'updated_at' => Carbon::parse('2023-06-11 07:11:22'), 'index' => 8, 'saldo_point' => 5000, 'hadiah' => null],
            ['id' => 14, 'nama' => '50.000', 'created_at' => Carbon::parse('2023-05-20 01:18:27'), 'updated_at' => Carbon::parse('2023-06-11 07:11:11'), 'index' => 7, 'saldo_point' => 50000, 'hadiah' => null],
            ['id' => 15, 'nama' => '10.000', 'created_at' => Carbon::parse('2023-05-20 01:18:32'), 'updated_at' => Carbon::parse('2023-06-11 07:10:57'), 'index' => 6, 'saldo_point' => 10000, 'hadiah' => null],
            ['id' => 16, 'nama' => 'ZONK', 'created_at' => Carbon::parse('2023-05-20 01:18:36'), 'updated_at' => Carbon::parse('2023-06-11 07:10:43'), 'index' => 5, 'saldo_point' => 0, 'hadiah' => null],
            ['id' => 17, 'nama' => '20.000', 'created_at' => Carbon::parse('2023-05-20 01:18:41'), 'updated_at' => Carbon::parse('2023-06-11 07:10:29'), 'index' => 4, 'saldo_point' => 20000, 'hadiah' => null],
            ['id' => 18, 'nama' => '1.000.000', 'created_at' => Carbon::parse('2023-05-20 01:18:45'), 'updated_at' => Carbon::parse('2023-06-11 07:10:19'), 'index' => 3, 'saldo_point' => 1000000, 'hadiah' => null],
            ['id' => 19, 'nama' => '2.000', 'created_at' => Carbon::parse('2023-05-20 01:18:49'), 'updated_at' => Carbon::parse('2023-06-11 07:10:05'), 'index' => 2, 'saldo_point' => 2000, 'hadiah' => null],
            ['id' => 20, 'nama' => '500.000', 'created_at' => Carbon::parse('2023-05-20 02:54:46'), 'updated_at' => Carbon::parse('2023-06-11 07:09:47'), 'index' => 1, 'saldo_point' => 500000, 'hadiah' => null],
            ['id' => 21, 'nama' => '10.000.000', 'created_at' => Carbon::parse('2023-05-20 02:54:51'), 'updated_at' => Carbon::parse('2023-06-11 07:09:56'), 'index' => 0, 'saldo_point' => 10000000, 'hadiah' => null],
            ['id' => 25, 'nama' => '5.000', 'created_at' => Carbon::parse('2023-06-11 07:12:31'), 'updated_at' => Carbon::parse('2023-06-11 07:12:31'), 'index' => 13, 'saldo_point' => 5000, 'hadiah' => null],
        ]);
    }
}
