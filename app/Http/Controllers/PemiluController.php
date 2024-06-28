<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use Exception;

class PemiluController extends Controller
{
    public function index()
    {
        return view('pemilu.index');
    }

    public function l21pemilu($jenis_event, $website, $androidid, $ip = "")
    {
        if ($jenis_event != 0) {
            return abort(404);
        }
        $data = Event::where('website', $website)->where('androidid', $androidid)->where('jenis_event', $jenis_event)->first();
        if ($data) {
            if ($data->username != '' || $data->username != null) {
                $status = $data->status;
                $url_spinner = $data->url_spinner;
                $vote = $data->vote;
                $username = $data->username;
                $id = $data->id;
                // dd($vote);
                return view('l21pemilu.vote', [
                    'url_spinner' => $url_spinner,
                    'status' => $status,
                    'vote' => $vote,
                    'username' => $username,
                    'id' => $id,
                    'website' => $website,
                    'jenis_event' => $jenis_event
                ]);
            } else {
                return view('l21pemilu.index', [
                    'website' => $website,
                    'androidid' => $androidid,
                    'ip' => $ip,
                    'jenis_event' => $jenis_event
                ]);
            }
        } else {
            return view('l21pemilu.index', [
                'website' => $website,
                'androidid' => $androidid,
                'ip' => $ip,
                'jenis_event' => $jenis_event
            ]);
        }
    }

    public function l21pemilu_store(Request $request, $jenis_event)
    {
        // Validasi input
        $request->validate([
            'userid' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'androidid' => 'required|string|max:255',
            'ip' => 'nullable|string|max:255'
        ]);

        // Cek apakah username sudah terdaftar untuk jenis event tertentu
        $username = Event::where('website', $request->website)
            ->where('username', $request->input('userid'))
            ->where('jenis_event', $jenis_event)
            ->first();

        if ($username) {
            return response()->json(['error' => 'Username sudah terdaftar'], 400);
        }

        // Buat instance model dan simpan data
        $Model = new Event();
        $Model->jenis_event = $jenis_event;
        $Model->ip = $request->input('ip');
        $Model->androidid = $request->input('androidid');
        $Model->kode = '';
        $Model->isklaim = 1;
        $Model->username = $request->input('userid');
        $Model->hadiah = 0;
        $Model->status = 0;
        $Model->keterangan = '';
        $Model->prize_id = 0;
        $Model->approve_by = '';
        $Model->website = $request->website;

        try {
            if ($Model->save()) {
                return response()->json(['message' => 'Data berhasil disimpan.'], 201);
            } else {
                return response()->json(['error' => 'Terjadi kesalahan saat menyimpan data.'], 500);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi pengecualian: ' . $e->getMessage()], 500);
        }
    }

    public function l21pemilu_update(Request $request)
    {
        $request->validate([
            'id' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'vote' => 'required|numeric'
        ]);

        $affectedRows = Event::where('id', $request->input('id'))
            ->update([
                'vote' => $request->input('vote')
            ]);

        if ($affectedRows > 0) {
            return response()->json(['message' => 'Data berhasil disimpan.'], 201);
        } else {
            return response()->json(['error' => 'Data tidak ditemukan atau tidak ada perubahan.'], 400);
        }
    }
}
