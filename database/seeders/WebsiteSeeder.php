<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('website')->insert([
            [
                'id' => 63,
                'nama' => 'arwanatoto',
                'link' => 'https://arwanakita.com/m',
                'livechat' => 'https://secure.livechatinc.com/licence/7760411/v2/open_chat.cgi',
                'whatsapp' => 'https://wa.me/6281349679137',
                'created_at' => Carbon::parse('2023-05-07 01:10:23'),
                'updated_at' => Carbon::parse('2023-05-30 05:04:57'),
            ],
            [
                'id' => 64,
                'nama' => 'jeeptoto',
                'link' => 'https://jeepkita.com/m',
                'livechat' => 'https://secure.livechatinc.com/licence/8577186/v2/open_chat.cgi?groups=0',
                'whatsapp' => 'https://wa.me/6281349679137',
                'created_at' => Carbon::parse('2023-05-07 01:11:13'),
                'updated_at' => Carbon::parse('2023-05-30 05:04:51'),
            ],
            [
                'id' => 65,
                'nama' => 'doyantoto',
                'link' => 'https://doyankita.com/m',
                'livechat' => 'https://secure.livechatinc.com/licence/8956469/v2/open_chat.cgi?groups=0',
                'whatsapp' => 'https://wa.me/6281349679137',
                'created_at' => Carbon::parse('2023-05-07 01:11:18'),
                'updated_at' => Carbon::parse('2023-05-30 05:04:45'),
            ],
            [
                'id' => 66,
                'nama' => 'tstoto',
                'link' => 'https://tskita.com/m',
                'livechat' => 'https://secure.livechatinc.com/licence/9271445/v2/open_chat.cgi',
                'whatsapp' => 'https://wa.me/6281349679137',
                'created_at' => Carbon::parse('2023-05-07 01:11:40'),
                'updated_at' => Carbon::parse('2023-05-30 05:04:39'),
            ],
            [
                'id' => 67,
                'nama' => 'arta4d',
                'link' => 'https://artakita.com/m',
                'livechat' => 'https://secure.livechatinc.com/licence/10396742/v2/open_chat.cgi', 'whatsapp' => 'https://wa.me/6281349679137',
                'whatsapp' => 'https://wa.me/6281349679137',
                'created_at' => Carbon::parse('2023-05-07 01:11:49'),
                'updated_at' => Carbon::parse('2023-05-30 05:04:31'),
            ],
            [
                'id' => 68,
                'nama' => 'neon4d',
                'link' => 'https://neonkita.com/m',
                'livechat' => 'https://secure.livechatinc.com/licence/9183465/v2/open_chat.cgi?groups=0',
                'whatsapp' => 'https://wa.me/6281349679137',
                'created_at' => Carbon::parse('2023-05-07 01:11:53'),
                'updated_at' => Carbon::parse('2023-05-30 05:04:23'),
            ],
            [
                'id' => 69,
                'nama' => 'zara4d',
                'link' => 'https://zarakita.com/m',
                'livechat' => 'https://secure.livechatinc.com/licence/11495623/v2/open_chat.cgi',
                'whatsapp' => 'https://wa.me/6281349679137',
                'created_at' => Carbon::parse('2023-05-07 01:11:56'),
                'updated_at' => Carbon::parse('2023-05-30 05:04:16'),
            ],
            [
                'id' => 70,
                'nama' => 'roma4d',
                'link' => 'https://romakita.com/m',
                'livechat' => 'https://direct.lc.chat/11392618/',
                'whatsapp' => 'https://wa.me/6281349679137',
                'created_at' => Carbon::parse('2023-05-07 01:27:23'),
                'updated_at' => Carbon::parse('2023-05-30 05:04:04'),
            ],
            [
                'id' => 71,
                'nama' => 'nero4d',
                'link' => 'https://nerokita.com/m',
                'livechat' => 'https://direct.lc.chat/12652677/',
                'whatsapp' => 'https://wa.me/6281349679137',
                'created_at' => Carbon::parse('2023-05-07 01:27:30'),
                'updated_at' => Carbon::parse('2023-05-30 05:04:09'),
            ],
            [
                'id' => 72,
                'nama' => 'duogaming',
                'link' => 'https://duo21slot.com',
                'livechat' => 'https://direct.lc.chat/9718355/',
                'whatsapp' => 'https://wa.me/6281349679137',
                'created_at' => Carbon::parse('2023-05-07 01:27:44'),
                'updated_at' => Carbon::parse('2023-05-30 05:03:50'),
            ],
            [
                'id' => 73,
                'nama' => 'diorgaming',
                'link' => 'http://156.67.217.88/',
                'livechat' => 'http://156.67.217.88/',
                'whatsapp' => 'https://wa.me/6281349679137',
                'created_at' => Carbon::parse('2023-06-01 14:22:21'),
                'updated_at' => Carbon::parse('2023-06-01 14:23:58'),
            ],
            [
                'id' => 74,
                'nama' => 'layargaming',
                'link' => 'http://156.67.217.88/',
                'livechat' => 'http://156.67.217.88/',
                'whatsapp' => 'https://wa.me/6281349679137',
                'created_at' => Carbon::parse('2023-06-01 14:22:21'),
                'updated_at' => Carbon::parse('2023-06-01 14:23:58'),
            ],
        ]);
    }
}
