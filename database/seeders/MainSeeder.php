<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            KeteranganSeeder::class,
            ListPrizeSeeder::class,
            UrlSpinSeeder::class,
            UsersTableSeeder::class,
            WebsiteSeeder::class,
            HadiahSeeder::class,
            SpinnerJenisVoucherSeeder::class,
            BonusUrlSeeder::class,
            BudgethadiahSeeder::class,
            FloatingimageSeeder::class
        ]);
    }
}
