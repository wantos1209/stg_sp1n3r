<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UrlSpinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('url_spin')->insert([
            'id' => 1,
            'url' => 'http://127.0.0.1:8000/spinnerl21?username=',
            'created_at' => null,
            'updated_at' => Carbon::now()
        ]);
    }
}
