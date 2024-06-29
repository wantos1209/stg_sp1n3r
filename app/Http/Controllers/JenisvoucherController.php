<?php

namespace App\Http\Controllers;

use App\Models\Jenisvoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisvoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisvoucher = Jenisvoucher::latest() // Menambahkan batasan limit 10
            ->get();
        // $results = Jenisvoucher::orderBy('created_at', 'desc')->paginate(8);
        return view('jenisvoucher.index', [
            'title' => 'Jenis Voucher',
            'data' => $jenisvoucher
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenisvoucher.create', [
            'title' => 'Jenis Voucher'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username_shorten' => 'required',
            'link_awal' => 'required',
            'link_hasil' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            try {
                Jenisvoucher::create($request->all());
                return response()->json([
                    'message' => 'Data berhasil disimpan.',
                ]);
            } catch (\Exception $e) {
                return response()->json(['errors' => ['Terjadi kesalahan saat menyimpan data.']]);
            }
        }

        return response()->json([
            'message' => 'Data berhasil disimpan.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Jenisvoucher $Jenisvoucher)
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
                $jenisvoucher[$index] = Jenisvoucher::where('id', $ids)->first();
            }
        } else {
            $jenisvoucher = [Jenisvoucher::where('id', $id)->first()];
        }

        return view('jenisvoucher.update', [
            'title' => 'Jenis Voucher',
            'data' => $jenisvoucher,
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
                $jenisvoucher[$index] = Jenisvoucher::where('id', $ids)->first();
            }
        } else {
            $jenisvoucher = [Jenisvoucher::where('id', $id)->first()];
        }

        return view('jenisvoucher.update', [
            'title' => 'Jenis Voucher',
            'data' => $jenisvoucher,
            'disabled' => 'disabled'
        ]);
    }


    public function data($id)
    {
        $data = Jenisvoucher::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        foreach ($id as $index => $idx) {
            $alldata = [
                "_token" => $data["_token"],
                'index' => $data["index"][$index],
                'nama' => $data["nama"][$index],
                'saldo_point' => preg_replace('/[,.]/', '', $data["saldo_point"][$index]),
            ];
            $validator = Validator::make($request->all(), [
                'index' => 'required',
                'nama' => 'required',
                'saldo_point' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                try {
                    $result = Jenisvoucher::find($idx);
                    $result->index = $alldata["index"];
                    $result->nama = $alldata["nama"];
                    $result->saldo_point = $alldata["saldo_point"];
                    $result->save();
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
                }
            }
        }
        return redirect('/jenisvoucher')->with('success', 'Data berhasil diupdate!');
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
            $Jenisvoucher = Jenisvoucher::findOrFail($id);
            $Jenisvoucher->delete();
        }

        return response()->json(['success' => 'Data berhasil dihapus!']);
    }
}
