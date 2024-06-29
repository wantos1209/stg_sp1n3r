<?php

namespace App\Http\Controllers;

use App\Models\Keterangan;
use App\Models\ApkBo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;

class KeteranganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keterangan = Keterangan::latest()
            ->get();
        return view('keterangan.index', [
            'title' => 'Keterangan',
            'data' => $keterangan
        ]);
    }

    public function create()
    {
        return view('keterangan.create', [
            'title' => 'Keterangan'
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keterangan' => ['required']
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            try {
                $data = $request->all();

                Keterangan::create($data);
                return redirect('/keterangan')->with('success', 'Keterangan berhasil ditambah!');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Keterangan $Keterangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $var1 = str_replace("&", " ", $id);
        $var2 = explode("values[]=", $var1);
        $var3 = array_slice($var2, 1);
        $var4 = str_replace(" ", "", $var3);

        if (!empty($var4)) {
            $id = $var4;
            foreach ($id as $index => $ids) {
                $keterangan[$index] = Keterangan::where('id', $ids)->first();
            }
        } else {
            $keterangan = [Keterangan::where('id', $id)->first()];
        }
        return view('keterangan.update', [
            'title' => 'Keterangan',
            'data' => $keterangan,
            'disabled' => ''
        ]);
    }

    public function views($id)
    {
        $var1 = str_replace("&", " ", $id);
        $var2 = explode("values[]=", $var1);
        $var3 = array_slice($var2, 1);
        $var4 = str_replace(" ", "", $var3);

        if (!empty($var4)) {
            $id = $var4;
            foreach ($id as $index => $ids) {
                $keterangan[$index] = Keterangan::where('id', $ids)->first();
            }
        } else {
            $keterangan = [Keterangan::where('id', $id)->first()];
        }
        return view('keterangan.update', [
            'title' => 'Keterangan',
            'data' => $keterangan,
            'disabled' => 'disabled'
        ]);
    }


    public function data($id)
    {
        $data = Keterangan::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $ids = $request->id;
        $data = $request->all();
        $errors = [];
        foreach ($ids as $index => $id) {
            $alldata = [
                'keterangan' => $data["keterangan"][$index]
            ];
            $validator = Validator::make($alldata, [
                'keterangan' => 'required'
            ]);

            if ($validator->fails()) {
                $errors[] = $validator->errors()->all();
            } else {
                try {
                    $keterangan = Keterangan::find($id);
                    $keterangan->keterangan = $alldata['keterangan'];
                    $keterangan->save();

                    return redirect('/keterangan')->with('success', 'Data berhasil diupdate!');
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
                }
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ids = $request->input('values');

        if (!is_array($ids)) {
            $ids = [$ids];
        }

        foreach ($ids as $id) {
            $keterangan = Keterangan::findOrFail($id);

            // Menghapus gambar terkait jika ada
            if ($keterangan->image) {
                Storage::delete('public/profileImg/' . $keterangan->image);
            }

            // Menghapus data pengguna
            $keterangan->delete();
        }

        return response()->json(['success' => 'Data berhasil dihapus!']);
    }
}
