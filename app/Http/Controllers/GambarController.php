<?php

namespace App\Http\Controllers;

use App\Models\FloatingImage;
use App\Models\Gambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class GambarController extends Controller
{

    public function index()
    {
        $gambars = FloatingImage::orderBy('created_at', 'DESC')->get()->toArray();
        return view('gambar.index', [
            'title' => 'List Gambar',
            'data' => $gambars
        ]);
    }

    public function create()
    {
        return view('gambar.create', [
            'title' => 'Create Gambar'
        ]);
    }

    public function view($id)
    {
        if (!is_array($id)) {
            $ids = [$id];
        }

        $response = FloatingImage::whereIn('id', $ids)->get()->toArray();

        return view('gambar.view', [
            'title' => 'View Gambar',
            'data' => $response
        ]);
    }


    public function edit($id)
    {
        $pattern = '/values\[\]=\s*(\d+)/';
        preg_match_all($pattern, $id, $matches);
        $ids = $matches[1];

        if (empty($ids)) {
            $ids = [$id];
        }

        $response = FloatingImage::whereIn('id', $ids)->get()->toArray();

        return view('gambar.update', [
            'title' => 'View Gambar',
            'data' => $response
        ]);
    }

    public function update(Request $request)
    {
        try {

            $ids = $request->id;
            $url = $request->url;

            foreach ($ids as $i => $id) {
                FloatingImage::where('id', $id)->update([
                    'url' => $url[$i]
                ]);
            }

            return redirect('/gambar/index')->with('success', 'Data budget berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.'])->withInput();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|string|max:255',
        ]);

        try {
            $floatingimage = new FloatingImage();
            $floatingimage->url = $request->url;

            $floatingimage->save();

            return redirect('/floatingimage/index')->with('success', 'Data floating image berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.'])->withInput();
        }
    }

    public function destroy(Request $request)
    {

        try {
            $ids = $request->values;
            if (!is_array($ids)) {
                $ids = [$ids];
            }

            FloatingImage::whereIn('id', $ids)->delete();
            return 'Success';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
