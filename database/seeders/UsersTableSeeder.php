<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'superadmin',
                'username' => 'superadmin',
                'divisi' => 'superadmin',
                'image' => '',
                'password' => Hash::make('superadmin'),
                // 'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'admin-arwana',
                'username' => 'admin-arwana',
                'divisi' => 'arwanatoto',
                'image' => '',
                'password' => Hash::make('admin-arwana'), // Gantilah 'admin' dengan kata sandi yang diinginkan
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'admin-jeep',
                'username' => 'admin-jeep',
                'divisi' => 'jeeptoto',
                'image' => '',
                'password' => Hash::make('admin-jeep'), // Gantilah 'admin' dengan kata sandi yang diinginkan
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'admin-ts',
                'username' => 'admin-ts',
                'divisi' => 'tstoto',
                'image' => '',
                'password' => Hash::make('admin-ts'), // Gantilah 'admin' dengan kata sandi yang diinginkan
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
