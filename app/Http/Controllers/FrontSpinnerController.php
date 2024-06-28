<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class FrontSpinnerController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $vouchers = Voucher::join('apk_bos', 'spinner_voucher.bo', '=', 'apk_bos.nama')
            ->select('spinner_voucher.*', 'apk_bos.site')
            ->get();
        return response()->json([
            'data' => $vouchers
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($userId)
    {
        $string = $userId;


        $pieces = explode('_', $string);

        // Mengakses potongan-potongan string hasil explode
        $userId = $pieces[0]; // "ayambakar02"
        $kodeVoucher = $pieces[1]; // "VOUCHER01"


        // $bolink = Voucher::where('kode_voucher', $kodeVoucher)->first()->bo;
        // $linkmaster = DB::table('apk_bos')
        //     ->where('nama', $bolink)
        //     ->first()->site;

        // $linklivechat = DB::table('apk_bos')
        //     ->where('nama', $bolink)
        //     ->first()->livechat;

        $voucher = Voucher::where('username', $userId)
            ->where('kode_voucher', $kodeVoucher)
            ->first();
        // $voucher->site = $linkmaster;
        // $voucher->livechat = $linklivechat;
        $voucher->site = 'https://duogaming.xn--6frz82g/referral/garansirungkad';

        $voucher->livechat = 'https://direct.lc.chat/9718355/';



        $sid = Voucher::where('username', $userId)->first()->username;
        $stok = Voucher::where('username', $userId)->first()->kode_voucher;

        if ($userId != $sid &&  $kodeVoucher != $stok) {
            return response()->json(['message' => 'Voucher not found'], 404);
        }

        return response()->json($voucher);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voucher $voucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voucher $voucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        //
    }
    public function updatevoucher($userid)
    {
        $parts = explode("_", $userid);
        $part1 = $parts[0];
        $part2 = $parts[1];

        $voucherid = Voucher::where('username', $part1)
            ->where('balance_kredit', 1)
            ->where('kode_voucher', $part2)
            ->first()
            ->id;

        if ($voucherid != '') {
            $updatevoucher = Voucher::where('id', $voucherid)->update([
                'balance_kredit' => 0,
                // 'userklaim' => $part1, // Ganti dengan field yang sesuai pada model User
                'tgl_klaim' => now()->addHours(7), // Menggunakan fungsi now() untuk mendapatkan timestamp saat ini
            ]);
        } else {
            $updatevoucher = 0;
        }
        if ($updatevoucher > 0) {
            return response()->json(['message' => 'Data updated successfully']);
        } else {
            return response()->json(['message' => 'Failed to update data']);
        }
    }


    public function jenisvoucher()
    {
        $responsevc = DB::table('spinner_jenisvoucher')
            ->get();

        return response()->json($responsevc);
    }
}
