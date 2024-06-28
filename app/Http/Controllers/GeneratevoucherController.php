<?php

namespace App\Http\Controllers;

use App\Models\GenerateVoucher;
use App\Models\Jenisvoucher;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Keterangan;
use App\Models\Website;

class GenerateVoucherController extends Controller
{
    public function index(Request $request, $isdemo = '0', $search_data = null)
    {
        $dataKeterangan = Keterangan::get();
        $dataWebsite = Website::get();
        $total_all_saldo = 100;
        $website = $request->input('website');
        $keterangan = $request->input('keterangan');

        $data = $this->getDataTable($isdemo, $website, $keterangan);
        $title = $isdemo == '1' ? ' (Demo)' : '';
        return view('generatevoucher.index', [
            'title' => 'Generate Voucher ' . $title,
            'menu' => 'bo',
            'data' => $data,
            'total_kalimvoucher' => 0,
            'total_voucher' => 0,
            'total_pengeluaran' => 0,
            'isdemo' => $isdemo,
            'search_data' => $search_data,
            'dataKeterangan' => $dataKeterangan,
            'dataWebsite' => $dataWebsite,
            'total_all_saldo' => $total_all_saldo,
            'website' => $website,
            'keterangan' => $keterangan
        ])->with('i', ($request->input('page', 1) - 1) * 1000);
    }

    public function getDataTable($isdemo, $website, $keterangan)
    {
        $filter = "WHERE 1 = 1 ";
        $divisi = auth()->user()->divisi;

        if ($divisi != 'admin' && $divisi != 'superadmin') {
            $filter .= " AND A.bo = '$divisi'";
        }

        if ($website) {
            $filter .= " AND A.bo = '$website'";
        }

        if ($keterangan) {
            $filter .= " AND A.keterangan = '$keterangan'";
        }

        $query = $this->querySql($isdemo, $filter);
        $query .= " LIMIT 100";

        $sql = DB::select($query);

        foreach ($sql as $index => $item) {
            $jenvoucher = explode(',', $item->jenis_voucher);
            $jenvoucher = array_map('intval', $jenvoucher);

            $presentase = explode(',', $item->presentase);
            $presentase = array_map('intval', $presentase);

            $jenis_voucher = [];
            foreach ($jenvoucher as $idx => $itm) {
                $queryJenvoucher = "SELECT nama FROM spinner_jenisvoucher WHERE `index` = '$itm'";
                $results = DB::select($queryJenvoucher);
                array_push($jenis_voucher, $results[0]->nama . ' ' . ($presentase[$idx] == '0' ? '100' : $presentase[$idx])  . '%');
            }
            $jenis_voucher = implode(", ", $jenis_voucher);
            $item->jen_voucher = $jenis_voucher;
            $agentid = "";
            if ($item->agentid != null || $item->agentid != '') {
                $agentid = User::where('id', $item->agentid)->first()->username;
            }
            $item->agentid = $agentid;
        }

        return $sql;
    }

    function querySql($isdemo, $filter)
    {
        $divisi = auth()->user()->divisi;
        $id = auth()->user()->id;
        if ($divisi != 'admin' && $divisi != 'superadmin') {
            $filter .= " AND A.agentid = '$id' ";
        }
        $query = "SELECT * FROM (
            SELECT 
            A.agentid,
            A.jenis_voucher, A.presentase, DATE(A.created_at) AS tgl_create,
            A.tipe_generate,A.target_bo, CASE coalesce(A.tipe_generate,0) WHEN '0' THEN G.total ELSE A.total_budget END AS total_budget,
            CASE WHEN A.tgl_exp < DATE(NOW()) THEN 1 ELSE 0 END as isexp, coalesce(A.isdemo,0) as isdemo,
            CASE WHEN COALESCE(D.total_kalimvoucher,0) = COALESCE(E.total_voucher,0) THEN 1 ELSE 0 END as ishabis,
            COALESCE(D.total_kalimvoucher,0) as total_kalimvoucher, COALESCE(E.total_voucher,0) as total_voucher,
            A.id,A.bo, B.nama, A.tgl_exp, A.keterangan, COALESCE(C.total_klaim,0) AS total_klaim, CONCAT(COALESCE(D.total_kalimvoucher,0), '/', COALESCE(E.total_voucher,0)) AS jumlah, 
            COALESCE(F.total,0) as total, A.created_at
             FROM spinner_generatevoucher A
            LEFT JOIN spinner_jenisvoucher B ON A.jenis_voucher = B.index
            LEFT JOIN (
            SELECT A.genvoucherid AS id, COUNT(A.id) AS total_klaim FROM spinner_voucher A
            INNER JOIN spinner_generatevoucher B ON A.genvoucherid = B.id
            WHERE tgl_klaim IS NOT NULL AND COALESCE(status_transfer,0) = 0
            GROUP BY A.genvoucherid
            ) C ON A.id = C.id
            LEFT JOIN (
            SELECT A.genvoucherid AS id, COUNT(A.id) AS total_kalimvoucher FROM spinner_voucher A
            INNER JOIN spinner_generatevoucher B ON A.genvoucherid = B.id
            /* WHERE tgl_klaim IS NOT NULL AND COALESCE(userklaim,'') <> '' */
            WHERE COALESCE(userklaim,'') <> ''
            GROUP BY A.genvoucherid
            ) D ON A.id = D.id
            LEFT JOIN (
            SELECT A.genvoucherid AS id, COUNT(A.id) AS total_voucher FROM spinner_voucher A
            INNER JOIN spinner_generatevoucher B ON A.genvoucherid = B.id
            GROUP BY A.genvoucherid
            ) E ON A.id = E.id
            LEFT JOIN (
            SELECT A.genvoucherid AS id, SUM(C.saldo_point) as total FROM spinner_voucher A
            INNER JOIN spinner_generatevoucher B ON A.genvoucherid = B.id
            LEFT JOIN spinner_jenisvoucher C ON A.jenis_voucher = C.index
            WHERE A.tgl_klaim IS NOT NULL
            GROUP BY A.genvoucherid
            ) F ON A.id = F.id
            LEFT JOIN (
            SELECT A.genvoucherid AS id, SUM(C.saldo_point) as total FROM spinner_voucher A
            INNER JOIN spinner_generatevoucher B ON A.genvoucherid = B.id
            LEFT JOIN spinner_jenisvoucher C ON A.jenis_voucher = C.index
            GROUP BY A.genvoucherid
            ) G ON A.id = G.id
            
            ) A
            $filter AND A.isdemo = '$isdemo'
            ORDER BY A.isexp ASC, COALESCE(A.total_klaim,0) DESC, A.ishabis ASC, A.created_at DESC
            ";
        return $query;
    }

    public function create($isdemo = 1, $search_data = null)
    {
        $datawebsite = Website::get();
        $website = [];
        foreach ($datawebsite as $web) {
            $website[] = $web->nama;
        }
        $jenis_voucher = Jenisvoucher::orderBy('nama', 'DESC')->get();

        $user = User::where('divisi', '!=', 'admin')->where('divisi', '!=', 'superadmin')->get()->toArray();
        $divisi = auth()->user()->divisi;
        //waktu sekarang +7 hari
        $now = time();
        $sevenDaysLater = strtotime('+7 days', $now);
        $datenow = date('Y-m-d', $sevenDaysLater);
        $dataKeterangan = Keterangan::get();

        return view('generatevoucher.create', [
            'title' => 'Generate Voucher',
            'website' => $website,
            'jenis_voucher' => $jenis_voucher,
            'datenow' => $datenow,
            'search_data' => $search_data,
            'isdemo' => $isdemo,
            'divisi' => $divisi,
            'datauser' => $user,
            'dataKeterangan' => $dataKeterangan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bo' => 'required',
            'jenis_voucher' => 'required',
            'tgl_exp' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required',
            'isdemo' => 'required',
            'total_budget' => 'required',
            'presentase' => 'required',
            'tipe_generate' => 'required',
            'target_bo' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            try {
                if ($request->tipe_generate == '1') {
                    $total_budget = intval(str_replace(',', '', $request->total_budget));
                    $budget = 0;
                    $presentase = array_filter($request->presentase, function ($element) {
                        return $element !== null;
                    });

                    $presentase = array_values($presentase);

                    foreach ($request->jenis_voucher as $index => $value) {
                        $jenis_voucher = Jenisvoucher::where('index', '=', $value)->first();
                        $budget += ($request->jumlah * ($presentase[$index] / 100)) * $jenis_voucher->saldo_point;
                    }

                    if ($budget > $total_budget) {
                        return redirect()->back()->with('error', 'Total jumlah melebihi budget, Mohon periksa kembali.');
                    }

                    if (array_sum($presentase) > 100) {
                        return redirect()->back()->with('error', 'Presentase tidak boleh melebihi 100%, Mohon cek kembali presentase yang anda masukkan.');
                    }
                }

                $alldata = $request->all();

                if ($request->tipe_generate == '1') {
                    $alldata["jenis_voucher"] = implode(',', $alldata["jenis_voucher"]);
                    $alldata["presentase"] = implode(',', $presentase);
                    $alldata["total_budget"] = $total_budget;
                } else {
                    $alldata["presentase"] = "0";
                }

                $generateVoucher = GenerateVoucher::create($alldata);
                try {
                    if ($request->tipe_generate == '1') {
                        $urutanArray = range(1, $request->jumlah);
                        shuffle($urutanArray);

                        foreach ($request->jenis_voucher as $index => $value) {
                            $jenis_voucher = Jenisvoucher::where('index', '=', $value)->first();
                            $jumlah_voucher = ($request->jumlah * ($presentase[$index] / 100));

                            for ($i = 0; $i < $jumlah_voucher; $i++) {
                                Voucher::create([
                                    'userid' => auth()->user()->username,
                                    'jenis_voucher' => $value,
                                    'kode_voucher' => $this->generateUniqueRandomString(10),
                                    'balance_kredit' => 1,
                                    'username' => 'voucher' . $this->generateUniqueRandomString2(5),
                                    'bo' => $generateVoucher->bo,
                                    'saldo' => $jenis_voucher->saldo_point,
                                    'userklaim' => '',
                                    'tgl_klaim' => null,
                                    'tgl_exp' => $request['tgl_exp'],
                                    'genvoucherid' => $generateVoucher->id,
                                    'urutan' => $urutanArray[$i]
                                ]);
                            }
                        }
                    } else {
                        $jenis_voucher = Jenisvoucher::where('index', '=', $generateVoucher->jenis_voucher)->first();
                        for ($i = 1; $i <= $generateVoucher->jumlah; $i++) {
                            try {
                                Voucher::create([
                                    'userid' => auth()->user()->username,
                                    'jenis_voucher' => $generateVoucher->jenis_voucher,
                                    'kode_voucher' => $this->generateUniqueRandomString(10),
                                    'balance_kredit' => 1,
                                    'username' => 'voucher' . $this->generateUniqueRandomString2(5),
                                    'bo' => $generateVoucher->bo,
                                    'saldo' => $jenis_voucher->saldo_point,
                                    'userklaim' => '',
                                    'tgl_klaim' => null,
                                    'tgl_exp' => $request['tgl_exp'],
                                    'genvoucherid' => $generateVoucher->id,
                                    'urutan' => $i
                                ]);
                            } catch (\Exception $e) {
                                return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
                            }
                        }
                    }

                    return redirect('/generatevoucher/' . $request->isdemo)->with('success', 'Data berhasil disimpan dan Voucher berhasil dibuat.');
                } catch (\Exception $e) {
                    dd($e->getMessage());
                    return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(GenerateVoucher $GenerateVoucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit($id)
    // {
    //     $var1 = str_replace("&", " ", $id);
    //     $var2 = explode("values[]=", $var1);
    //     $var3 = array_slice($var2, 1);
    //     $var4 = str_replace(" ", "", $var3);

    //     if (!empty($var4)) {
    //         $id = $var4;
    //         foreach ($id as $index => $ids) {
    //             $generatevoucher[$index] = GenerateVoucher::where('id', $ids)->first();
    //         }
    //     } else {
    //         $generatevoucher = [GenerateVoucher::where('id', $id)->first()];
    //     }

    //     return view('generatevoucher.update', [
    //         'title' => 'Generate Voucher',
    //         'data' => $generatevoucher,
    //         'disabled' => '',
    //         // 'search_data' => $search_data
    //     ]);
    // }

    public function edit($id)
    {
        $var1 = str_replace("&", " ", $id);
        $var2 = explode("values[]=", $var1);
        $var3 = array_slice($var2, 1);
        $var4 = str_replace(" ", "", $var3);

        if (!empty($var4)) {
            $id = $var4;
            foreach ($id as $index => $ids) {
                $generatevoucher[$index] = GenerateVoucher::where('id', $ids)->first();
            }
        } else {
            $generatevoucher = [GenerateVoucher::where('id', $id)->first()];
        }

        $datawebsite = Website::get();
        $website = [];
        foreach ($datawebsite as $web) {
            $website[] = $web->nama;
        }
        $dataKeterangan = Keterangan::get();


        return view('generatevoucher.update', [
            'title' => 'Generate Voucher',
            'data' => $generatevoucher,
            'disabled' => '',
            'website' => $website,
            'dataKeterangan' => $dataKeterangan
            // 'search_data' => $search_data
        ]);
    }




    public function update(Request $request)
    {
        $ids = $request->input('id');

        foreach ($ids as $index => $id) {
            $validator = Validator::make($request->all(), [
                'bo.' . $index => 'required',
                'target_bo.' . $index => 'required',
                'tgl_exp.' . $index => 'required|date'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->all()]);
            } else {
                try {
                    $result = GenerateVoucher::find($id);

                    $result->bo = $request->input('bo')[$index];
                    $result->target_bo = $request->input('target_bo')[$index];
                    $result->keterangan = $request->input('keterangan')[$index];
                    $result->tgl_exp = $request->input('tgl_exp')[$index];
                    $result->save();
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
                }
            }
        }

        return redirect('/generatevoucher')->with('success', 'Data berhasil diupdate.');
    }

    public function data($id)
    {
        $data = GenerateVoucher::find($id);
        return response()->json($data);
    }

    public function destroy(Request $request)
    {
        $ids = $request->input('values');

        if (!is_array($ids)) {
            $ids = [$ids];
        }

        try {
            foreach ($ids as $id) {
                $generateVoucher = GenerateVoucher::findOrFail($id);
                $generateVoucher->delete();

                Voucher::where('genvoucherid', $id)->delete();
            }
            return response()->json(['success' => 'Data berhasil dihapus!']);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            dd($errorMessage);
            return response()->json(['errors' => 'Terjadi kesalahan saat menghapus data.']);
        }
    }

    function generateUniqueRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $maxCharIndex = strlen($characters) - 1;

        do {
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $maxCharIndex)];
            }
        } while ($this->cekData($randomString));

        return $randomString;
    }

    function generateUniqueRandomString2($length)
    {
        do {
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= rand(0, 9);
            }
        } while ($this->cekJenisVoucher($randomString));

        return $randomString;
    }

    function cekData($string)
    {
        $count = Voucher::where('kode_voucher', $string)->count();
        return $count > 0;
    }

    function cekJenisVoucher($string)
    {
        $count = Voucher::where('username', $string)->count();
        return $count > 0;
    }
    function getDataTotal($filter_website = "", $filter_keterangan = "")
    {
        $filter = "WHERE 1=1 ";

        if ($filter_website != '') {
            $filter .= " AND A.bo = '$filter_website'";
        }

        if ($filter_keterangan != '') {
            $filter .= " AND A.keterangan = '$filter_keterangan'";
        }

        $query = "
        SELECT A.id, CASE COALESCE(A.tipe_generate,0) WHEN '0' THEN G.total ELSE A.total_budget END AS total_budget FROM spinner_generatevoucher A
        LEFT JOIN (
            SELECT A.genvoucherid AS id, SUM(C.saldo_point) as total FROM spinner_voucher A
            INNER JOIN spinner_generatevoucher B ON A.genvoucherid = B.id AND B.isdemo = '0'
            LEFT JOIN spinner_jenisvoucher C ON A.jenis_voucher = C.index
            GROUP BY A.genvoucherid
        ) G ON A.id = G.id
        $filter
        ";

        $sql = "SELECT SUM(COALESCE(A.total_budget,0)) as total_budget FROM (
            $query
        ) A";

        $results = DB::select($sql);
        return $results;
    }
    public function loadTotal(Request $request)
    {
        try {
            $filter_website = $request->input('filter_website');
            $filter_keterangan = $request->input('filter_keterangan');

            $data = $this->getDataTotal($filter_website, $filter_keterangan);

            return response()->json(['data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat memproses permintaan.'], 500);
        }
    }
}
