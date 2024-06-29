<?php

namespace App\Http\Controllers;

use App\Models\ListPrize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class ListPrizeController extends Controller
{

    public function index()
    {
        $listprizes = ListPrize::orderBy('created_at')->get()->toArray();
        return view('listprize.index', [
            'title' => 'List ListPrize',
            'data' => $listprizes
        ]);
    }

    public function create()
    {
        return view('listprize.create', [
            'title' => 'Create ListPrize'
        ]);
    }

    public function view($id)
    {
        if (!is_array($id)) {
            $ids = [$id];
        }

        $response = ListPrize::where('id', $ids)->get()->toArray();

        return view('listprize.view', [
            'title' => 'View Budget',
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

        $response = ListPrize::where('id', $ids)->get()->toArray();

        return view('listprize.update', [
            'title' => 'View ListPrize',
            'data' => $response
        ]);
    }

    public function update(Request $request)
    {
        try {

            $ids = $request->id;
            $nama = $request->nama;
            $unit = $request->unit;

            foreach ($ids as $i => $id) {
                ListPrize::where('id', $id)->update([
                    'nama' => $request->nama[$i],
                    'unit' => $request->unit[$i]
                ]);
            }

            return redirect('/listprize/index')->with('success', 'Data budget berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.'])->withInput();
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'unit' => 'required|integer',
            ]);

            $budget = new ListPrize();
            $budget->nama = $request->nama;
            $budget->unit = $request->unit;

            $budget->save();

            return redirect('/listprize/index')->with('success', 'Data budget berhasil disimpan.');
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

            ListPrize::whereIn('id', $ids)->delete();

            return 'Success';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
