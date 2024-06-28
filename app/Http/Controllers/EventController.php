<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\ListPrize;
use App\Models\UrlSpin;
use App\Models\Voucher;
use App\Models\Website;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function index($jenis_event, $website = "")
    {
        try {
            if ($website == "") {
                $website = 'arwanatoto';
            }

            $divisi = auth()->user()->divisi;
            if ($divisi == 'arwana') {
                $website = 'arwanatoto';
            } else if ($divisi == 'jeep') {
                $website = 'jeeptoto';
            } else if ($divisi == 'doyantoto') {
                $website = 'doyantoto';
            } else if ($divisi == 'tstoto') {
                $website = 'tstoto';
            } else if ($divisi == 'arta') {
                $website = 'arta4d';
            } else if ($divisi == 'neon') {
                $website = 'neon4d';
            } else if ($divisi == 'zara') {
                $website = 'zara4d';
            } else if ($divisi == 'roma') {
                $website = 'roma4d';
            } else if ($divisi == 'nero') {
                $website = 'nero4d';
            } else if ($divisi == 'duo') {
                $website = 'duogaming';
            } else if ($divisi == 'dior') {
                $website = 'diorgaming';
            } else if ($divisi == 'toke') {
                $website = 'toke4d';
            }


            $data = $this->getDataEvent($website, $jenis_event);
            $filteredData = array_filter($data, function ($item) {
                return $item['isklaim'] == 1 && $item['status'] != 2;
            });

            $hadiahArray =  $divisi == 'admin' ? array_column($filteredData, 'hadiah') : 0;

            $saldoterpakai = $divisi == 'admin' ? array_sum($hadiahArray) : 0;
            $countApprove = $divisi == 'admin' ? count($hadiahArray) : 0;

            $allsadloterpakai = $divisi == 'admin' ? $this->getSaldoTerpakai($jenis_event)["totalsaldo"] : 0;
            $countTotalAll = $divisi == 'admin' ? $this->getSaldoTerpakai($jenis_event)["totalcontapprove"] : 0;

            $events = array_slice($data, 0, 100);
            // $events = $filteredData;
            return view('event.index', [
                'title' => 'List Event',
                'data' => $events,
                'website' => $website,
                'divisi' => $divisi,
                'totalbudget' => $divisi == 'admin' ? $this->getSaldoTotalBudget($jenis_event)[0]["budget"] : 0,
                'saldoterpakai' => $saldoterpakai,
                'allsadloterpakai' => $allsadloterpakai,
                'countTotalAll' => $countTotalAll,
                'countApprove' => $countApprove,
                'jenis_event' => $jenis_event,
                'datawebsite' => Website::get()
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function getTestApi()
    {
        $apiUrl = "https://www.situscepat.org/api/calonical/arta4d";
        $token = "p0l0s4TRy";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($apiUrl);
            if ($response->successful()) {
                $events = $response->json();
                return $events["totalsaldo"];
            } else {
                return response()->json(['error' => 'Error: Failed to fetch data from the API'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    function getSaldoTerpakai($jenis_event)
    {
        $apiUrl = "http://127.0.0.1:8040/api/totalsaldo/" . $jenis_event;
        $token = "youk1llmyfvcking3x";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($apiUrl);
            if ($response->successful()) {
                $events = $response->json();

                return $events;
            } else {
                return response()->json(['error' => 'Error: Failed to fetch data from the API'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    function getSaldoTotalBudget($jenis_event)
    {
        $apiUrl = "http://127.0.0.1:8040/api/budget/" . $jenis_event;
        $token = "youk1llmyfvcking3x";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($apiUrl);
            if ($response->successful()) {
                $events = $response->json();
                return $events["data"];
            } else {
                return response()->json(['error' => 'Error: Failed to fetch data from the API'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function indexproses($jenis_event, $website = '')
    {

        $datawebsite = Website::get();
        $divisi = auth()->user()->divisi;
        // $countwebsite = $this->getCountWebsite($jenis_event);
        $username = auth()->user()->username;

        $eventsQuery = Event::where('jenis_event', $jenis_event)
            ->where('status', 0)
            ->where('isklaim', 1)
            ->where('vote', '!=', 0);

        /* Count Data */
        $totalCount = $this->getDataCount($eventsQuery);
        foreach ($datawebsite as &$web) {
            $web->totalCount = isset($totalCount[$web->nama]) ? $totalCount[$web->nama] : 0;
        }

        if ($website != '') {
            $eventsQuery->where('website', $website);
        }

        if ($jenis_event == 1) {
            $eventsQuery->where('vote', '!=', 0);
        }
        $events = $eventsQuery->get()->toArray();



        return view('event.indexproses', [
            'title' => 'Proses Event',
            'website' => $website,
            'username' => $username,
            'data' => $events,
            // 'countwebsite' => $countwebsite,
            'divisi' => $divisi,
            'jenis_event' => $jenis_event,
            'datawebsite' => $datawebsite
        ]);
    }

    public function indexapproval($jenis_event, $website = '')
    {
        $divisi = auth()->user()->divisi;

        $datawebsite = Website::get();

        $username = auth()->user()->username;

        $eventsQuery = Event::where('jenis_event', $jenis_event)
            ->where('isklaim', 0)
            ->where('status', 0);

        /* Count Data */
        $totalCount = $this->getDataCount($eventsQuery);

        if ($website != '') {
            $eventsQuery->where('website', $website);
        }

        $events = $eventsQuery->get()->toArray();

        foreach ($datawebsite as &$web) {
            $web->totalCount = isset($totalCount[$web->nama]) ? $totalCount[$web->nama] : 0;
        }

        return view('event.indexapproval', [
            'title' => 'Proses Event',
            'website' => $website,
            // 'countwebsite' => $countwebsite,
            'divisi' => $divisi,
            'jenis_event' => $jenis_event,
            'datawebsite' => $datawebsite,
            'username' => $username,
            'data' => $events
        ]);
    }

    private function getDataCount($queryCount)
    {
        return (array_count_values(array_column($queryCount->get()->toArray(), 'website')));
    }

    function getCountWebsite($jenis_event)
    {
        $apiUrl = "http://127.0.0.1:8040/api/countprosesweb/" . $jenis_event;
        $token = "youk1llmyfvcking3x";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($apiUrl);
            if ($response->successful()) {
                $events = $response->json();
                return $events["data"];
            } else {
                return response()->json(['error' => 'Error: Failed to fetch data from the API'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function countproses($jenis_event)
    {
        $divisi = auth()->user()->divisi;
        $website = '';
        if ($divisi == 'arwana') {
            $website = 'arwanatoto';
        } else if ($divisi == 'jeep') {
            $website = 'jeeptoto';
        } else if ($divisi == 'doyantoto') {
            $website = 'doyantoto';
        } else if ($divisi == 'tstoto') {
            $website = 'tstoto';
        } else if ($divisi == 'arta') {
            $website = 'arta4d';
        } else if ($divisi == 'neon') {
            $website = 'neon4d';
        } else if ($divisi == 'zara') {
            $website = 'zara4d';
        } else if ($divisi == 'roma') {
            $website = 'roma4d';
        } else if ($divisi == 'nero') {
            $website = 'nero4d';
        } else if ($divisi == 'duo') {
            $website = 'duogaming';
        } else if ($divisi == 'dior') {
            $website = 'diorgaming';
        }

        if ($jenis_event == 0) {
            $apiUrl = "http://127.0.0.1:8040/api/dataproses/" . 1 . '/' . $jenis_event . '/' .  $website;
        } else {
            $apiUrl = "http://127.0.0.1:8040/api/dataprosesapp/" . $jenis_event . '/' .  $website;
        }
        // dd($apiUrl);
        $token = "youk1llmyfvcking3x";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($apiUrl);
            if ($response->successful()) {
                $events = $response->json();
                return $events["data"];
            } else {
                return response()->json(['error' => 'Error: Failed to fetch data from the API'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function create($jenis_event, $website)
    {
        $divisi = auth()->user()->divisi;
        $datawebsite = Website::get();

        return view('event.create', [
            'title' => 'Create Event',
            'website' => $website,
            'divisi' => $divisi,
            'jenis_event' => $jenis_event,
            'datawebsite' => $datawebsite
        ]);
    }

    public function store(Request $request, $jenis_event)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'androidid' => 'required|string|max:255',
            'ip' => 'nullable|string|max:255',
            'website' => 'required|string|max:255',
        ]);

        try {
            $all_request = $request->all();
            $all_request["jenis_event"] = $jenis_event;
            $all_request["kode"] = 0;
            $all_request["isklaim"] = 1;

            $event = new Event($all_request);
            $event->save();

            $url = '/dataevent/index/' . $all_request['jenis_event'] . '/' . $all_request['website'];
            return redirect($url)->with('success', 'Event created successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function view($jenis_event, $website, $id)
    {
        $events = Event::where('id', $id)->first();
        return view('event.view', [
            'title' => 'View Event',
            'data' => $events,
            'website' => $website,
            'jenis_event' => $jenis_event
        ]);
    }

    public function edit($jenis_event, $website, $id)
    {
        $pattern = '/values\[\]=\s*(\d+)/';
        preg_match_all($pattern, $id, $matches);
        $ids = $matches[1];

        if (empty($ids)) {
            $ids = [$id];
        }

        $events = Event::whereIn('id', $ids)->get();
        return view('event.update', [
            'title' => 'Edit Event',
            'data' => $events,
            'website' => $website,
            'dataprize' => $this->getPrize(),
            'jenis_event' => $jenis_event
        ]);
    }

    function getPrize()
    {
        $apiUrl = "http://127.0.0.1:8040/api/listprize/";

        $token = "youk1llmyfvcking3x";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($apiUrl);

            if ($response->successful()) {
                $events = $response->json();
                return $events;
            } else {
                return response()->json(['error' => 'Error: Failed to fetch data from the API'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $jenis_event, $website)
    {

        try {
            $allrequest = $request->all();
            foreach ($allrequest["id"] as $i => $id) {
                Event::where('id', $id)->update([
                    'androidid' => $allrequest["androidid"][$i],
                    'kode' => $allrequest["kode"][$i],
                    'ip' => $allrequest["ip"][$i],
                    'username' => $allrequest["username"][$i],
                    'prize_id' => isset($allrequest["prize_id"][$i]) ? $allrequest["prize_id"][$i] : 0
                ]);
            }
            $url = '/dataevent/index/' . $jenis_event . '/' . $website;
            return redirect($url)->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Request $request, $jenis_event, $website)
    {
        try {
            $ids = $request->values;

            if (!is_array($ids)) {
                $ids = [$ids];
            }

            $apiUrl = 'http://127.0.0.1:8040/api/kodedelete/' . $jenis_event . '/' . $website;


            $ch = curl_init($apiUrl);

            $token = 'youk1llmyfvcking3x';
            $headers = [
                'Authorization: Bearer ' . $token,
                'Content-Type: application/x-www-form-urlencoded', // Sesuaikan sesuai kebutuhan
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($ids));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            if ($response === false) {
                throw new \Exception('Curl error: ' . curl_error($ch));
            }

            curl_close($ch);

            return 'Success';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function updateketerangan(Request $request, $jenis_event, $website, $id)
    {
        try {
            $allrequest = $request->all();

            Event::where('id', $id)->update([
                'keterangan' => $allrequest['keterangan']
            ]);
            return 'Success';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function updateurl_spinner(Request $request, $jenis_event, $website, $id)
    {
        try {
            $allrequest = $request->all();

            $dataToUpdate = $allrequest;
            $apiUrl = 'http://127.0.0.1:8040/api/updateurlspinner/' . $jenis_event . '/' . $website . '/' . $id;
            $ch = curl_init($apiUrl);

            $token = 'youk1llmyfvcking3x';
            $headers = [
                'Authorization: Bearer ' . $token,
                'Content-Type: application/x-www-form-urlencoded',
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataToUpdate));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            if ($response === false) {
                throw new \Exception('Curl error: ' . curl_error($ch));
            }
            curl_close($ch);

            return 'Success';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    function getUrlSpinner($userklaim, $website)
    {
        $url = UrlSpin::first();
        $url = $url->url;
        $currentDate = date("Y-m-d");

        $divisi = auth()->user()->divisi;
        $agentid = auth()->user()->id;
        if (!($divisi == 'admin' || $divisi == 'superadmin')) {
            $filterAgentid = " AND B.agentid = '$agentid'";
        } else {
            $filterAgentid = "";
        }

        $sqlcount = "SELECT count(A.id) as total FROM spinner_voucher A
        INNER JOIN spinner_generatevoucher B on A.genvoucherid = B.id AND B.keterangan = 'BONUS PEMILU' AND B.bo = '$website' $filterAgentid
        WHERE B.tgl_exp >= '$currentDate' AND COALESCE(A.userklaim,'') = ''";
        $resultcount = DB::select($sqlcount);
        if ($resultcount[0]->total >= count($userklaim)) {
            $allUrlSpinn = [];
            foreach ($userklaim as $user) {
                $sql = "SELECT A.* FROM spinner_voucher A
                INNER JOIN spinner_generatevoucher B on A.genvoucherid = B.id AND B.keterangan = 'BONUS PEMILU' AND B.bo = '$website' $filterAgentid
                WHERE B.tgl_exp >= '$currentDate' AND COALESCE(A.userklaim,'') = '' LIMIT 1";
                $results = DB::select($sql);

                $username = $results[0]->username;
                $kode_voucher = $results[0]->kode_voucher;
                $id = $results[0]->id;

                Voucher::where('id', $id)->update(['userklaim' => $user]);

                $allurl =  $url . $username . '_' . $kode_voucher;
                $allUrlSpinn[] = $allurl;
            }
            return $allUrlSpinn;
        } else {
            return null;
        }
    }

    public function changestatus(Request $request, $jenis_event, $website, $status)
    {
        try {
            $dataToUpdate = $request->all();
            $dataToUpdate["approve_by"] = auth()->user()->username;
            if (isset($dataToUpdate["username"]) && $dataToUpdate["username"] != '') {
                parse_str($dataToUpdate["username"], $username);
                if (isset($username['username'])) {
                    $username = $username['username'];
                } else {
                    $username = null;
                }
            } else {
                $username = null;
            }

            if ($jenis_event == '0' && $status == 1) {
                if ($status == '1') {
                    if ($username) {
                        $allUrlSpinn = $this->getUrlSpinner($username, $website);
                        if (!empty($allUrlSpinn)) {
                            $dataToUpdate["url_spinner"] = $allUrlSpinn;
                        }
                    }
                }

                if ($status == '1' && $allUrlSpinn == null) {
                    return response()->json(['errors' => 'Jumlah voucher kurang, Harap minta Admin MT untuk membuat voucher Pemilu lagi']);
                }
            }

            parse_str($dataToUpdate['id'], $parsedIds);
            $id = array_map('intval', $parsedIds['values']);

            Event::whereIn('id', $id)->update([
                'status' => $status,
                'url_spinner' => $status == 1 ? $dataToUpdate["url_spinner"] : '',
                'approve_by' => auth()->user()->username,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            return 'Success';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function changestatusApproval(Request $request, $jenis_event, $website, $isklaim)
    {
        try {
            $id = $request->all()['id'];
            parse_str($id, $ids);
            $ids = array_map('intval', $ids['values']);

            if ($isklaim == 2) {
                Event::whereIn('id', $ids)->where('jenis_event', $jenis_event)->update([
                    'status' => $isklaim,
                    'approve_by' => auth()->user()->username,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            } else {
                Event::whereIn('id', $ids)->where('jenis_event', $jenis_event)->update([
                    'isklaim' => $isklaim,
                    'approve_by' => auth()->user()->username,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }

            return 'Success';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }


    // function getDataVoucher()
    // {
    //     $sql = "SELECT * FROM spinner_voucher A
    //     INNER JOIN spinner_generatevoucher B ON A.genvoucherid = B.id
    //     WHERE B.keterangan ='EVENT PEMILU' AND B.tgl_exp >= '2024-01-17' AND A.balance_kredit = '1' AND COALESCE(A.userklaim,'') = '' 
    //     LIMIT 1";

    //     $results = DB::select($sql);
    //     return $results;
    // }

    function getCountDataVoucher()
    {
        $sql = "SELECT COUNT(A.id) as totalvoucher FROM spinner_voucher A
        INNER JOIN spinner_generatevoucher B ON A.genvoucherid = B.id
        WHERE B.keterangan ='EVENT PEMILU' AND B.tgl_exp >= '2024-01-17' AND A.balance_kredit = '1' AND COALESCE(A.userklaim,'') = '' 
        ";

        $results = DB::select($sql);
        return $results;
    }

    public function findkodeevent($jenis_event, $search = "")
    {
        // dd($search);
        $events = Event::where('jenis_event', $jenis_event)
            ->where(function ($query) use ($search) {
                $query->where('androidid', 'like', '%' . $search . '%')
                    ->orWhere('website', 'like', '%' . $search . '%')
                    ->orWhere('ip', 'like', '%' . $search . '%')
                    ->orWhere('username', 'like', '%' . $search . '%')
                    ->orWhere('keterangan', 'like', '%' . $search . '%')
                    ->orWhere('url_spinner', 'like', '%' . $search . '%');
            })
            ->get()->toArray();

        return view('event.findkode', [
            'title' => 'Find Event',
            'data' => $events,
            'search' => $search,
            'jenis_event' => $jenis_event
        ]);
    }

    public function findkodeview($jenis_event, $website, $id, $search = "")
    {
        $divisi = auth()->user()->divisi;
        $events = Event::where('jenis_event', $jenis_event)
            ->where(function ($query) use ($search) {
                $query->where('androidid', 'like', '%' . $search . '%')
                    ->orWhere('website', 'like', '%' . $search . '%')
                    ->orWhere('ip', 'like', '%' . $search . '%')
                    ->orWhere('username', 'like', '%' . $search . '%')
                    ->orWhere('keterangan', 'like', '%' . $search . '%')
                    ->orWhere('url_spinner', 'like', '%' . $search . '%');
            })->where('id', $id);

        if ($divisi != 'superadmin' && $divisi != 'admin') {
            $events->where('website', $divisi);
        }
        $events = $events->get()->toArray();

        return view('event.findkodeview', [
            'title' => 'View Event',
            'data' => $events,
            'website' => $website,
            'search' => $search,
            'jenis_event' => $jenis_event
        ]);
    }

    public function findkodeedit($jenis_event, $website, $id, $search = "")
    {
        $divisi = auth()->user()->divisi;
        $events = Event::where('jenis_event', $jenis_event)
            ->where(function ($query) use ($search) {
                $query->where('androidid', 'like', '%' . $search . '%')
                    ->orWhere('website', 'like', '%' . $search . '%')
                    ->orWhere('ip', 'like', '%' . $search . '%')
                    ->orWhere('username', 'like', '%' . $search . '%')
                    ->orWhere('keterangan', 'like', '%' . $search . '%')
                    ->orWhere('url_spinner', 'like', '%' . $search . '%');
            })->where('id', $id);

        if ($divisi != 'superadmin' && $divisi != 'admin') {
            $events->where('website', $divisi);
        }
        $events = $events->get()->toArray();

        return view('event.findkodeupdate', [
            'title' => 'Edit Event',
            'data' => $events,
            'website' => $website,
            'search' => $search,
            'jenis_event' => $jenis_event
        ]);
    }

    public function findkodedestroy(Request $request, $jenis_event, $website, $search = "")
    {
        try {
            $ids = $request->values;

            if (!is_array($ids)) {
                $ids = [$ids];
            }

            $apiUrl = 'http://127.0.0.1:8040/api/kodedelete/' . $jenis_event . '/' . $website;


            $ch = curl_init($apiUrl);

            $token = 'youk1llmyfvcking3x';
            $headers = [
                'Authorization: Bearer ' . $token,
                'Content-Type: application/x-www-form-urlencoded', // Sesuaikan sesuai kebutuhan
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($ids));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            if ($response === false) {
                throw new \Exception('Curl error: ' . curl_error($ch));
            }

            curl_close($ch);

            return 'Success';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function deleteDataBatal()
    {
        try {
            $apiUrl = 'http://127.0.0.1:8040/api/deletecanceldata';


            $ch = curl_init($apiUrl);

            $token = 'youk1llmyfvcking3x';
            $headers = [
                'Authorization: Bearer ' . $token,
                'Content-Type: application/x-www-form-urlencoded', // Sesuaikan sesuai kebutuhan
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($ids));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            if ($response === false) {
                throw new \Exception('Curl error: ' . curl_error($ch));
            }

            curl_close($ch);

            return 'Success';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function FetchAllData($jenis_event)
    {
        $apiUrl = "http://127.0.0.1:8040/api/alldata/" . $jenis_event;
        $token = "youk1llmyfvcking3x";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($apiUrl);

            if ($response->successful()) {
                $data = $response->json();

                $filteredData = array_filter($data["data"], function ($item) {
                    return $item['status'] == '0';
                });

                return $filteredData;
            } else {
                return response()->json(['error' => 'Error: Failed to fetch data from the API'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function print($jenis_event)
    {

        $data = $this->FetchAllData($jenis_event);
        // $data = json_decode($data, false)
        $data = array_map(function ($item) {
            return (object) $item;
        }, $data);
        $dataArray = [];
        $dataArray[] = ["No", "Username", "Keterangan", "Website", "Device ID", "Kode", "Link", "IP", "Status Klaim", "Status Approve", "Prize", "Approve By"];
        foreach ($data as $index => $d) {

            $rowData = [
                $index + 1,
                $d->username,
                $d->keterangan,
                $d->website,
                $d->androidid,
                $d->kode,
                $d->ip,
                $d->isklaim == '1' ? 'Sudah Klaim' : 'Belum Klaim',
                $d->status == '1' ? 'Approve' : '',
                $d->prize_id == '0' ? 'Belum Diset' : '',
                $d->approve_by
            ];
            $dataArray[] = $rowData;
        }
        return response()->json($dataArray ?? [], Response::HTTP_OK);
    }
    public function countEventApproval()
    {
        $divisi = auth()->user()->divisi;
        $countwebsite = $this->getCountApprovalWebsite(1);


        if ($divisi == 'arwana') {
            $website = 'arwanatoto';
        } else if ($divisi == 'jeep') {
            $website = 'jeeptoto';
        } else if ($divisi == 'doyantoto') {
            $website = 'doyantoto';
        } else if ($divisi == 'tstoto') {
            $website = 'tstoto';
        } else if ($divisi == 'arta') {
            $website = 'arta4d';
        } else if ($divisi == 'neon') {
            $website = 'neon4d';
        } else if ($divisi == 'zara') {
            $website = 'zara4d';
        } else if ($divisi == 'roma') {
            $website = 'roma4d';
        } else if ($divisi == 'nero') {
            $website = 'nero4d';
        } else if ($divisi == 'duo') {
            $website = 'duogaming';
        } else if ($divisi == 'dior') {
            $website = 'diorgaming';
        }

        if ($divisi == 'admin') {
            $countwebsite = array_sum($countwebsite);
        } else {
            $countwebsite = $countwebsite[$website];
        }
        return response()->json(['totalcount' => $countwebsite]);
    }

    public function getdata(Request $request, $website, $jenis_event)
    {

        if ($website == 'arwanatoto') {
            $data = BonusArwanatoto::latest()->where('jenis_event', $jenis_event)->get();
        } else if ($website == 'arta4d') {
            $data = BonusArta4d::latest()->where('jenis_event', $jenis_event)->get();
        } else if ($website == 'roma4d') {
            $data = BonusRoma4d::latest()->where('jenis_event', $jenis_event)->get();
        } else if ($website == 'zara4d') {
            $data = BonusZara4d::latest()->where('jenis_event', $jenis_event)->get();
        } else if ($website == 'tstoto') {
            $data = BonusTstoto::latest()->where('jenis_event', $jenis_event)->get();
        } else if ($website == 'neon4d') {
            $data = BonusNeon4d::latest()->where('jenis_event', $jenis_event)->get();
        } else if ($website == 'nero4d') {
            $data = BonusNero4d::latest()->where('jenis_event', $jenis_event)->get();
        } else if ($website == 'jeeptoto') {
            $data = BonusJeeptoto::latest()->where('jenis_event', $jenis_event)->get();
        } else if ($website == 'doyantoto') {
            $data = BonusDoyantoto::latest()->where('jenis_event', $jenis_event)->get();
        } else if ($website == 'diorgaming') {
            $data = BonusDiorgaming::latest()->where('jenis_event', $jenis_event)->get();
        } else if ($website == 'duogaming') {
            $data = BonusDuogaming::latest()->where('jenis_event', $jenis_event)->get();
        } else if ($website == 'toke4d') {
            $data = BonusToke4d::latest()->where('jenis_event', $jenis_event)->get();
        } else {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        if (!$data->isEmpty()) {
            foreach ($data as &$item) {
                $item->androidid_user = "guest_" . substr($item->androidid, -5);
                $item->website = $website;
                $item->prize =  $item->prize_id != 0 ? ListPrize::where('id', $item->prize_id)->first()->nama : '0';
            }
        }

        return response()->json(['data' => $data]);
    }

    public function getDataEvent($website, $jenis_event)
    {
        $data = Event::latest()->where('website', $website)->where('jenis_event', $jenis_event)->get();

        if (!$data->isEmpty()) {
            foreach ($data as &$item) {
                $item->androidid_user = "guest_" . substr($item->androidid, -5);
                $item->website = $website;
                $item->prize =  $item->prize_id != 0 ? ListPrize::where('id', $item->prize_id)->first()->nama : '0';
            }
        }

        return $data->toArray();
    }
}
