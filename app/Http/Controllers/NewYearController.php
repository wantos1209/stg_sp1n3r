<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\BonusDuogaming;
use App\Models\BonusJeeptoto;
use App\Models\BonusTstoto;
use App\Models\BonusDoyantoto;
use App\Models\BonusNeon4d;
use App\Models\BonusZara4d;
use App\Models\BonusRoma4d;
use App\Models\BonusNero4d;
use App\Models\BonusDiorgaming;
use App\Models\Hadiah;
use App\Models\Website;

class ImlekController extends Controller
{
    public function l21imlek($jenis_event, $website, $androidid, $ip = "")
    {
        if ($jenis_event != 1) {
            return abort(404);
        }
        $dataContact = Website::where('nama', $website)->first();
        $livechat = $dataContact->livechat;
        $whatsapp = $dataContact->whatsapp;

        $data = Event::where('androidid', $androidid)->where('jenis_event', $jenis_event)->first();
        if ($data) {
            if ($data->username != '' || $data->username != null) {
                $status = $data->status;
                $isklaim = $data->isklaim;
                $vote = $data->vote;
                $username = $data->username;
                $id = $data->id;
                $savedValue = $data->hadiah;
                // dd($vote);
                return view('frontimlek.imlek.angpao', [
                    'status' => $status,
                    'isklaim' => $isklaim,
                    'vote' => $vote,
                    'username' => $username,
                    'id' => $id,
                    'website' => $website,
                    'whatsapp' => $whatsapp,
                    'livechat' => $livechat,
                    'jenis_event' => $jenis_event,
                    'savedValue' => $savedValue
                ]);
            } else {
                return view('frontimlek.imlek.index', [
                    'website' => $website,
                    'androidid' => $androidid,
                    'ip' => $ip,
                    'whatsapp' => $whatsapp,
                    'livechat' => $livechat,
                    'jenis_event' => $jenis_event
                ]);
            }
        } else {
            return view('frontimlek.imlek.index', [
                'website' => $website,
                'androidid' => $androidid,
                'ip' => $ip,
                'whatsapp' => $whatsapp,
                'livechat' => $livechat,
                'jenis_event' => $jenis_event
            ]);
        }
    }

    public function l21imlek_store(Request $request)
    {
        $request->validate([
            'userid' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'androidid' => 'required|string|max:255',
            'jenis_event' => 'required|string|max:255'
        ]);

        $Model = new Event();
        $username = Event::where('username', $request->input('userid'))->where('jenis_event', $request->input('jenis_event'))->first();

        if ($username) {
            return response()->json(['error' => 'Username sudah terdaftar'], 400);
        }

        $hadiah = Hadiah::get();
        $hadiahRandom = $this->getRewardByPercentage($hadiah);
        $hadiahRandom = $hadiahRandom > 100000 ? 0 : $hadiahRandom;
        $hadiahRandom = $hadiahRandom == 10000000 || $hadiahRandom == '10000000' ? 0 : $hadiahRandom;

        $Model->jenis_event = $request->input('jenis_event');
        $Model->ip = $request->input('ip');
        $Model->androidid = $request->input('androidid');
        $Model->kode = '';
        $Model->isklaim = 0;
        $Model->username = $request->input('userid');
        $Model->hadiah = $request->input('jenis_event') == '0' ? 0 : $hadiahRandom;
        $Model->status = 0;
        $Model->keterangan = '';
        $Model->prize_id = 0;
        $Model->website = $request->input('website');
        $Model->approve_by = '';

        if ($Model->save()) {
            return response()->json(['message' => 'Data berhasil disimpan.'], 201);
        } else {
            return response()->json(['error' => 'Website tidak valid.'], 400);
        }
    }

    function getRewardByPercentage($rewards)
    {
        $rewards = $rewards->toArray();

        // Total persentase dari semua hadiah
        $totalPercentage = array_sum(array_column($rewards, 'persentase'));

        // Menghasilkan angka acak antara 0 dan total persentase
        $randomNumber = mt_rand(0, $totalPercentage);

        // Inisialisasi variabel untuk menyimpan hadiah yang dipilih
        $selectedReward = null;

        // Iterasi melalui setiap hadiah
        foreach ($rewards as $reward) {
            // Mengurangkan persentase hadiah saat ini dari angka acak
            $randomNumber -= $reward['persentase'];

            // Jika angka acak kurang dari atau sama dengan 0, maka hadiah ini dipilih
            if ($randomNumber <= 0) {
                $selectedReward = $reward;
                break;
            }
        }

        return $selectedReward['hadiah'];
    }

    public function getDataHadiah()
    {
        $data = Hadiah::get();
        return $data;
    }

    public function postDataHadiah(Request $request)
    {
        $vote = $request->input('vote');
        $id = $request->input('id');
        $website = $request->input('website');

        $request->validate([
            'id' => 'required|numeric',
            'vote' => 'required|numeric',
            'website' => 'required|string|max:255'
        ]);

        if ($website == 'arta4d') {
            $updated = Event::where('id', $id)->update([
                'vote' => $vote,
            ]);
            if (!$updated) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan atau tidak ada perubahan'
                ], 404);
            }
        } else if ($website == 'arwanatoto') {
            $updated = Event::where('id', $id)->update([
                'vote' => $vote,
            ]);
            if (!$updated) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan atau tidak ada perubahan'
                ], 404);
            }
        } else if ($website == 'duogaming') {
            $updated = BonusDuogaming::where('id', $id)->update([
                'vote' => $vote,
            ]);
            if (!$updated) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan atau tidak ada perubahan'
                ], 404);
            }
        } else if ($website == 'jeeptoto') {
            $updated = BonusJeeptoto::where('id', $id)->update([
                'vote' => $vote,
            ]);
            if (!$updated) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan atau tidak ada perubahan'
                ], 404);
            }
        } else if ($website == 'tstoto') {
            $updated = BonusTstoto::where('id', $id)->update([
                'vote' => $vote,
            ]);
            if (!$updated) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan atau tidak ada perubahan'
                ], 404);
            }
        } else if ($website == 'doyantoto') {
            $updated = BonusDoyantoto::where('id', $id)->update([
                'vote' => $vote,
            ]);
            if (!$updated) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan atau tidak ada perubahan'
                ], 404);
            }
        } else if ($website == 'neon4d') {
            $updated = BonusNeon4d::where('id', $id)->update([
                'vote' => $vote,
            ]);
            if (!$updated) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan atau tidak ada perubahan'
                ], 404);
            }
        } else if ($website == 'zara4d') {
            $updated = BonusZara4d::where('id', $id)->update([
                'vote' => $vote,
            ]);
            if (!$updated) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan atau tidak ada perubahan'
                ], 404);
            }
        } else if ($website == 'roma4d') {
            $updated = BonusRoma4d::where('id', $id)->update([
                'vote' => $vote,
            ]);
            if (!$updated) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan atau tidak ada perubahan'
                ], 404);
            }
        } else if ($website == 'nero4d') {
            $updated = BonusNero4d::where('id', $id)->update([
                'vote' => $vote,
            ]);
            if (!$updated) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan atau tidak ada perubahan'
                ], 404);
            }
        } else if ($website == 'diorgaming') {
            $updated = BonusDiorgaming::where('id', $id)->update([
                'vote' => $vote,
            ]);
            if (!$updated) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan atau tidak ada perubahan'
                ], 404);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diperbarui'
        ]);
    }
}
