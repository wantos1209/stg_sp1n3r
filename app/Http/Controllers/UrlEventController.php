<?php

namespace App\Http\Controllers;

use App\Models\ApkBo;
use App\Models\BonusUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;


class UrlEventController extends Controller
{
    public function index()
    {
        $urlevents = BonusUrl::get()->toArray();

        return view('urlevent.index', [
            'title' => 'List UrlEvent',
            'data' => $urlevents
        ]);
    }

    public function view($id)
    {
        $pattern = '/values\[\]=\s*(\d+)/';
        preg_match_all($pattern, $id, $matches);
        $ids = $matches[1];

        if (empty($ids)) {
            $ids = [$id];
        }

        try {
            $urlevents = BonusUrl::whereIn('id', $ids)->get()->toArray();

            return view('urlevent.view', [
                'title' => 'View UrlEvent',
                'data' => $urlevents
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function edit($id)
    {
        $pattern = '/values\[\]=\s*(\d+)/';
        preg_match_all($pattern, $id, $matches);
        $ids = $matches[1];

        if (empty($ids)) {
            $ids = [$id];
        }

        $urlevents = BonusUrl::whereIn('id', $ids)->get()->toArray();

        return view('urlevent.update', [
            'title' => 'View UrlEvent',
            'data' => $urlevents
        ]);
    }

    public function update(Request $request)
    {
        try {
            $req = $request->all();
            $ids = $req["id"];
            $urls = $req["url"];

            foreach ($ids as $i => $id) {
                BonusUrl::where('id', $id)->update([
                    'url' => $urls[$i]
                ]);
            }

            return redirect('/urlevent/index')->with('success', 'Data berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
    public function clearCache($website)
    {
        $url = 'http://127.0.0.1:8040/api/cleacCacheApi/' . $website;
        $token = 'Bearer youk1llmyfvcking3x';

        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->get($url);

        $data = $response->json();

        return response()->json($data);
    }

    public function website()
    {
        $website = [
            'arwanatoto', 'jeeptoto', 'doyantoto', 'tstoto', 'arta4d', 'neon4d', 'zara4d', 'roma4d', 'nero4d', 'duogaming', 'ortugaming', 'filagaming', 'diorgaming'
        ];

        return $website;
    }
}
