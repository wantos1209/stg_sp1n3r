<?php

namespace App\Http\Controllers;

use App\Models\Hadiah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class HadiahController extends Controller
{

    public function index()
    {
        try {
            $hadiahs = Hadiah::orderBy('created_at', 'DESC')->get()->toArray();

            return view('hadiah.index', [
                'title' => 'List Hadiah',
                'data' => $hadiahs
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function create()
    {
        return view('hadiah.create', [
            'title' => 'Create Hadiah'
        ]);
    }

    public function view($id)
    {
        try {
            if (!is_array($id)) {
                $ids = [$id];
            }

            $response = Hadiah::whereIn('id', $ids)->get()->toArray();

            return view('hadiah.view', [
                'title' => 'View Budget',
                'data' => $response
            ]);
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }


    public function edit($id)
    {
        try {
            $pattern = '/values\[\]=\s*(\d+)/';
            preg_match_all($pattern, $id, $matches);
            $ids = $matches[1];

            if (empty($ids)) {
                $ids = [$id];
            }

            $response = Hadiah::whereIn('id', $ids)->get()->toArray();

            return view('hadiah.update', [
                'title' => 'View Hadiah',
                'data' => $response
            ]);
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function update(Request $request)
    {
        try {

            $ids = $request->id;
            $hadiah = $request->hadiah;
            $persentase = $request->persentase;

            foreach ($ids as $i => $id) {
                Hadiah::where('id', $id)->update([
                    'hadiah' => $hadiah[$i],
                    'persentase' => $persentase[$i]
                ]);
            }

            return redirect('/hadiah/index')->with('succewss', 'Data berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'hadiah' => 'required|numeric',
            'persentase' => 'required|integer',
        ]);

        try {
            $hadiah = new Hadiah();
            $hadiah->hadiah = $request->hadiah;
            $hadiah->persentase = $request->persentase;
            $hadiah->save();

            return redirect('/hadiah/index')->with('success', 'Data hadiah berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.'])->withInput();
        }
    }

    public function destroy(Request $request)
    {

        try {
            $ids = $request->values;
            if (!is_array($ids)) {
                $ids = array($ids);
            }

            Hadiah::whereIn('id', $ids)->delete();
            return 'Success';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
