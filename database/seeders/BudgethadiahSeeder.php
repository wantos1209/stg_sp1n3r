<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BudgethadiahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('budgethadiah')->insert([
            [
                'id' => 1,
                'budget' => 100000000,
                'created_at' => NULL,
                'updated_at' => NULL,
                'jenis_event' => 0,
                'nama_event' => NULL,
            ],
            [
                'id' => 4,
                'budget' => 100000000,
                'created_at' => '2024-02-12 08:58:58',
                'updated_at' => '2024-02-12 09:02:47',
                'jenis_event' => 1,
                'nama_event' => 'want3',
            ],
        ]);
    }
}
