<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;

class NewYearController extends Controller
{

    public function l21newyear($jenis_event, $website, $deviceid)
    {
        $livechat = $this->getLinkContact($website)["livechat"];
        $whatsapp = $this->getLinkContact($website)["whatsapp"];
        $button_title = $this->getLinkButton($website)["title"];
        $button_url = $this->getLinkButton($website)["url"];
        // $livechat = '';
        // $button_title = '';
        // $button_url = '';


        $response = Http::withHeaders([
            'Authorization' => 'Bearer youk1llmyfvcking3x',
        ])->get('http://127.0.0.1:8040/api/kode/' . $website . '/' . $deviceid);
        // dd($response->json()["data"]);
        $data = $response->json()["data"];

        $allresponse = Http::withHeaders([
            'Authorization' => 'Bearer youk1llmyfvcking3x',
        ])->get('http://127.0.0.1:8040/api/alldata');
        $alldata = isset($allresponse->json()["data"]) ? $allresponse->json()["data"] : [];

        $filteredData = array_filter($alldata, function ($item) {
            return $item['isklaim'] == 1 && $item['status'] == 1;
        });

        usort($filteredData, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        $alldata = $filteredData;
        $alldata = json_encode($alldata);

        if ($data[0]['prize_id'] == '1') {
            $gambar = "nmax-l21.png";
        } else if ($data[0]['prize_id'] == '2') {
            $gambar = "vario-l21.png";
        } else if ($data[0]['prize_id'] == '3') {
            $gambar = "laptop-l21.png";
        } else if ($data[0]['prize_id'] == '4') {
            $gambar = "hp-l21.png";
        } else if ($data[0]['prize_id'] == '5') {
            $gambar = "tv-l21.png";
        } else if ($data[0]['prize_id'] == '6') {
            $gambar = "voucher-l21.png";
        }

        if (isset($gambar)) {
            $pathgambar = '/img/pemenang/' . $gambar;
        } else {
            $pathgambar = '';
        }

        if (isset($data[0])) {
            if ($data[0]["isklaim"] == '1') {
                return view('frontnewyear.indexhalaman', [
                    'title' => 'Hadiah',
                    'alldata' => $alldata,
                    'data' => $data[0],
                    'datenow' => date('Y-m-d'),
                    'livechat' => $livechat,
                    'whatsapp' => $whatsapp,
                    'button_title' => $button_title,
                    'button_url' => $button_url,
                    'pathgambar' => $pathgambar
                ]);
            } else {
                return view('frontnewyear.index', [
                    'title' => 'Hadiah',
                    'data' => $data[0],
                    'livechat' => $livechat,
                    'whatsapp' => $whatsapp,
                    'button_title' => $button_title,
                    'button_url' => $button_url,
                    'pathgambar' => ''
                ]);
            }
        } else {
            return view('frontnewyear.index', [
                'title' => 'Hadiah',
                'data' => $data,
                'livechat' => $livechat,
                'whatsapp' => $whatsapp,
                'button_title' => $button_title,
                'button_url' => $button_url,
                'pathgambar' => $pathgambar
            ]);
        }
    }

    function getLinkContact($website)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer youk1llmyfvcking3x',
        ])->get('http://127.0.0.1:8040/api/contactwebsite/' . $website);

        $otherData = [
            'livechat' => '',
            'whatsapp' => '',
            'button_title' => '',
            'button_url' => ''
        ];

        $data = isset($response->json()["data"][0]) ? $response->json()["data"][0] : $otherData;
        return $data;
    }

    function getLinkButton($website)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer youk1llmyfvcking3x',
        ])->get('http://127.0.0.1:8040/api/buttonsetting/');

        $otherData = [
            'title' => '',
            'url' => ''
        ];

        $data = isset($response->json()["data"][0]) ? $response->json()["data"][0] : $otherData;
        return $data;
    }

    public function l21newyear_update($jenis_event, $website, $deviceid, $username)
    {
        $username = strtolower($username);
        $result = $this->putData($website, $deviceid, $username);

        if (isset($result['error'])) {
            return $result;
        } else {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer youk1llmyfvcking3x',
            ])->get('http://127.0.0.1:8040/api/updateklaim/' . $website . '/' . $deviceid);

            $data = $response->json()["data"];
            return $data;
        }
    }

    function putData($website, $deviceid, $username)
    {
        $url = 'http://127.0.0.1:8040/api/updateusername/' . $website . '/' . $deviceid;

        $data = [
            'username' => $username,
        ];
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer youk1llmyfvcking3x',
        ]);

        $response = curl_exec($ch);
        $response = json_decode($response, true);
        return $response;
    }
}
