<?php

namespace App\Http\Controllers;

use App\Models\UrlSpin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;


class UrlSpinController extends Controller
{
    public function index()
    {
        $urlevent = UrlSpin::all();
        return view('urlspin.index', [
            'data' => $urlevent,
            'title' => 'URL Spinner'
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
        $urlevent = UrlSpin::findOrFail($id);
        return view('urlspin.update', [
            'data' => $urlevent,
            'disabled' => 'disabled',
            'title' => 'URL Spinner'
        ]);
    }


    public function edit($id)
    {
        $pattern = '/values\[\]=\s*(\d+)/';
        preg_match_all($pattern, $id, $matches);
        if (isset($matches[1]) && is_array($matches[1]) && !empty($matches[1])) {
            $id = $matches[1][0];
        }




        $urlevent = UrlSpin::findOrFail($id);
        return view('urlspin.update', [
            'data' => $urlevent,
            'disabled' => '',
            'title' => 'URL Spinner'
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'url.*' => 'required',
            ]);

            $urlevent = UrlSpin::findOrFail($id);
            $urlevent->update([
                'url' => $request->url[0]
            ]);

            return redirect('/urlspin/index')->with('success', 'Data berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function getDataUrl()
    {
        try {
            $urlevent = UrlSpin::findOrFail(1);
            return response()->json($urlevent, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
