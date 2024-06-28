<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id, $isdemo = 0, $search_data = null)
    {
        $sql = $this->querySql($id);
        $results = DB::select($sql);

        return view('voucher.index', [
            'title' => 'Voucher',
            'data' => $results,
            'isproses' => false,
            'id' => $id,
            'isdemo' => $isdemo,
            'search_data' => $search_data
        ]);
    }

    public function index_search(Request $request, $id, $search = '')
    {
        $sql = $this->querySql($id, $search);
        $results = DB::select($sql);

        return view('voucher.index_search', [
            'title' => 'Voucher',
            'data' => $results,
            'isproses' => false,
            'id' => $id,
            'search' => $search
        ]);
    }

    public function print(String $id)
    {
        if ($id) {
            $sql = $this->querySqlLaporan($id);

            $data = DB::select($sql);
            $dataArray = [];
            $dataArray[] = ["No", "Jenis Voucher", "Keterangan", "Kode Voucher", "Link", "Nama Bo", "Rekening", "Status Proses"];
            foreach ($data as $index => $d) {
                $status_transfer = $d->status_transfer == '1' ? 'Sudah' : 'Belum';
                $rowData = [
                    $index + 1,
                    $d->tipe_generate == '0' ?  $d->jenis_voucher : ($d->tgl_klaim != '' ? $d->jenis_voucher : '{ Random }'),
                    $d->keterangan,
                    $d->kode_voucher,
                    $d->user_kode . '_' . $d->kode_voucher,
                    $d->bo,
                    $d->log,
                    $status_transfer
                ];
                $dataArray[] = $rowData;
            }
        }
        return response()->json($dataArray ?? [], Response::HTTP_OK);
    }

    public function printView(String $id)
    {
        if ($id) {
            $sql = $this->querySql($id);

            $data = DB::select($sql);
            $dataArray = [];
            $dataArray[] = ["No", "Jenis Voucher", "Keterangan", "Kode Voucher", "Link", "Nama Bo", "Rekening"];
            foreach ($data as $index => $d) {
                $rowData = [
                    $index + 1,
                    $d->tipe_generate == '0' ?  $d->jenis_voucher : ($d->tgl_klaim != '' ? $d->jenis_voucher : '{ Random }'),
                    $d->keterangan,
                    $d->kode_voucher,
                    $d->user_kode . '_' . $d->kode_voucher,
                    $d->bo,
                    $d->log
                ];
                $dataArray[] = $rowData;
            }
        }
        return response()->json($dataArray ?? [], Response::HTTP_OK);
    }

    public function printProses(String $id)
    {
        if ($id) {
            $sql = $this->querySqlProses($id);

            $data = DB::select($sql);
            $dataArray = [];
            $dataArray[] = ["No", "Jenis Voucher", "Keterangan", "Kode Voucher", "Link", "Nama Bo", "Rekening"];
            foreach ($data as $index => $d) {
                $rowData = [
                    $index + 1,
                    $d->jenis_voucher,
                    $d->keterangan,
                    $d->kode_voucher,
                    $d->user_kode . '_' . $d->kode_voucher,
                    $d->bo,
                    $d->log
                ];
                $dataArray[] = $rowData;
            }
        }
        return response()->json($dataArray ?? [], Response::HTTP_OK);
    }

    public function indexProses(Request $request, $id, $isdemo = 0, $search_data = null)
    {
        $isprosesById = '1';
        $sql = $this->querySqlProses($id, '', $isdemo, $isprosesById);
        $results = DB::select($sql);
        return view('voucher.index', [
            'title' => 'Voucher',
            'data' => $results,
            'isproses' => true,
            'id' => $id,
            'isdemo' => $isdemo,
            'search_data' => $search_data
        ]);
    }


    public function indexProsesAll(Request $request, $search_data = null)
    {
        $sql = $this->querySqlProses('', $search_data);
        $results = DB::select($sql);
        return view('voucher.indexProsesAll', [
            'title' => 'Voucher',
            'data' => $results,
            'isproses' => true,
        ]);
    }

    public function tableProsesAll(Request $request, $search_data = null)
    {
        $sql = $this->querySqlProses('', $search_data);
        $results = DB::select($sql);
        return view('voucher.tableProsesAll', [
            'title' => 'Voucher',
            'data' => $results,
            'isproses' => true,
            'search_data' => $search_data
        ]);
    }

    public function querySql($id, $search = '')
    {
        $filter = "WHERE 1=1";
        $limit = '';
        if ($id != 0) {
            $filter .= " AND (A.genvoucherid= '$id' AND A.userklaim = '' AND A.tgl_klaim is null)";
        } else {
            $limit = " limit 10";
        }

        $filter .= "";

        if ($search != '') {
            $filter .= " AND (A.kode_voucher LIKE  '%$search%' OR A.username LIKE  '%$search%' OR A.userklaim LIKE  '%$search%')";
        }

        if (!(auth()->user()->divisi == 'superadmin' || auth()->user()->divisi == 'admin')) {
            $website = auth()->user()->divisi;
            $filter .= " AND A.bo='$website'";
        }

        $sql = "
            SELECT D.username, B.tipe_generate, A.id, A.userklaim, coalesce(B.isdemo,0) as isdemo, B.bo, B.userid as log,
            C.nama AS jenis_voucher, B.keterangan, A.username AS user_kode, A.kode_voucher, A.userklaim AS norek, A.tgl_klaim, A.status_transfer, A.tgl_exp, A.userid AS `log`
            FROM spinner_voucher A 
            INNER JOIN spinner_generatevoucher B ON A.genvoucherid = B.id
            LEFT JOIN spinner_jenisvoucher C ON A.jenis_voucher = C.index
            LEFT JOIN users D on B.agentid = D.id
            $filter
            ORDER BY A.urutan
            $limit  
        ";
        return $sql;
    }

    public function querySqlProses($id = '', $search_data = '', $isdemo = '0', $isprosesById = '0')
    {
        $filter = "WHERE 1=1";
        $website = auth()->user()->divisi;
        $userid = auth()->user()->id;
        if ($id == '') {
            // $filter .= " AND A.userklaim <> '' AND A.tgl_klaim is not null";
            $filter .= " AND A.tgl_klaim is not null";
        } else {
            $filter .= " AND A.genvoucherid= '$id' AND (A.userklaim <> '' OR A.tgl_klaim is not null)";
        }

        if ($search_data != '') {
            $filter .= " AND (A.kode_voucher LIKE  '%$search_data%' OR A.username LIKE  '%$search_data%')";
        }

        if (!(auth()->user()->divisi == 'superadmin' || auth()->user()->divisi == 'admin')) {
            $filter .= " AND B.target_bo = '$website'";
        }

        if ($isprosesById == '0') {
            $filter .= " AND coalesce(A.status_transfer,0) = '0'";
        }
        if (!($website == 'admin' || $website == 'superadmin')) {
            $filter .= " AND B.agentid = '$userid' ";
        }

        $filter .= " AND A.tgl_exp >= CURDATE() AND B.isdemo = '$isdemo'";

        $sql = "
        SELECT * FROM (
            SELECT 
            D.username,
            B.tipe_generate,
            A.id, A.userklaim, coalesce(B.isdemo,0) as isdemo, A.bo as website,
            C.nama AS jenis_voucher, B.keterangan, A.username AS user_kode, A.kode_voucher, A.userklaim AS norek, A.tgl_klaim, coalesce(A.status_transfer,0) as status_transfer, A.tgl_exp, A.userid AS `log`,
            CASE WHEN A.tgl_klaim IS NULL THEN 0 ELSE 1 END as istglklaim
            FROM spinner_voucher A 
            INNER JOIN spinner_generatevoucher B ON A.genvoucherid = B.id
            LEFT JOIN spinner_jenisvoucher C ON A.jenis_voucher = C.index
            LEFT JOIN users D on B.agentid = D.id
            $filter
        ) AS A
        ORDER BY A.status_transfer ASC , A.istglklaim DESC
        
        ";
        return $sql;
    }

    public function querySqlLaporan($id)
    {
        $sql = "
            SELECT B.tipe_generate, A.id, A.userklaim, coalesce(B.isdemo,0) as isdemo, B.bo, B.userid as log,
            C.nama AS jenis_voucher, B.keterangan, A.username AS user_kode, A.kode_voucher, A.userklaim AS norek, A.tgl_klaim, A.status_transfer, A.tgl_exp, A.userid AS `log`
            FROM spinner_voucher A 
            INNER JOIN spinner_generatevoucher B ON A.genvoucherid = B.id
            LEFT JOIN spinner_jenisvoucher C ON A.jenis_voucher = C.index
            WHERE A.genvoucherid= '$id'
            ORDER BY A.urutan
        ";
        return $sql;
    }
    public function data($id)
    {
        $data = Voucher::find($id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        foreach ($id as $index => $idx) {
            $validator = Validator::make($request->all(), [
                'username_shorten.*' => 'required',
                'link_awal.*' => 'required',
                'link_hasil.*' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->all()]);
            } else {
                try {
                    $result = Voucher::find($idx);
                    $result->username_shorten = $request->username_shorten[$index];
                    $result->link_awal = $request->link_awal[$index];
                    $result->link_hasil = $request->link_hasil[$index];
                    $result->save();
                } catch (\Exception $e) {
                    return response()->json(['errors' => ['Terjadi kesalahan saat menyimpan data.']]);
                }
            }
        }
        return response()->json(['success' => 'Item berhasil diupdate!']);
    }

    public function inputuserid(Request $request, $id)
    {
        $userklaim = $request->input('userklaim');
        Voucher::where('id', $id)->update([
            'userklaim' => $userklaim
        ]);
        return response()->json(['message' => 'Data berhasil diupdate']);
    }

    public function updateStatus(Request $request)
    {
        $id = $request->input('id');
        $isChecked = $request->input('isChecked');

        $voucher = Voucher::findOrFail($id);
        $voucher->status_transfer = $isChecked == 'true' ? '1' : '0';
        $voucher->save();

        return response()->json(['success' => true]);
    }

    public function updateUserklaim(Request $request)
    {
        $id = $request->input('id');
        $userklaim = $request->input('userklaim');

        $voucher = Voucher::findOrFail($id);
        $voucher->userklaim = $userklaim;
        $voucher->save();

        return response()->json(['success' => true]);
    }

    public function deleteUserklaim(Request $request)
    {
        $id = $request->input('id');
        $voucher = Voucher::findOrFail($id);
        $voucher->userklaim = '';
        $voucher->save();

        return response()->json(['success' => true]);
    }

    public function countvoucher()
    {
        $sql = $this->querySqlProses();
        $sql = "SELECT * FROM ($sql) A WHERE A.status_transfer = '0'";

        $sqlcount = "SELECT COUNT(A.id) as totalcount FROM ($sql) A";
        $results = DB::select($sqlcount);

        return $results;
    }
}
