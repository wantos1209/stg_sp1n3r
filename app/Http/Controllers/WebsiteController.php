<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class WebsiteController extends Controller
{
    public function index()
    {
        $website = Website::orderBy('created_at')->get()->toArray();
        return view('website.index', [
            'title' => 'List Website',
            'data' => $website
        ]);
    }

    public function create()
    {
        return view('website.create', [
            'title' => 'Create Website'
        ]);
    }

    public function view($id)
    {
        if (!is_array($id)) {
            $ids = [$id];
        }

        $response = Website::whereIn('id', $id)->get()->toArray();
        return view('website.view', [
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
        $response = Website::whereIn('id', $ids)->get()->toArray();

        return view('website.update', [
            'title' => 'View Website',
            'data' => $response
        ]);
    }

    public function update(Request $request)
    {
        try {
            $ids = $request->id;
            $website = $request->website;
            $livechat = $request->livechat;
            $whatsapp = $request->whatsapp;

            foreach ($ids as $i => $id) {
                Website::where('id', $id)->update([
                    'website' => $website[$i],
                    'livechat' => $livechat[$i],
                    'whatsapp' => $whatsapp[$i]
                ]);
            }

            return redirect('/website/index')->with('success', 'Data website berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.'])->withInput();
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'link' => 'required|string|max:255',
                'livechat' => 'required|string|max:255',
                'whatsapp' => 'required|string|max:255'
            ]);

            $website = new Website();
            $website->nama = $request->nama;
            $website->link = $request->link;
            $website->livechat = $request->livechat;
            $website->whatsapp = $request->whatsapp;

            $website->save();

            return redirect('/website/index')->with('success', 'Data website berhasil disimpan.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function destroy(Request $request)
    {

        try {
            $ids = $request->values;
            if (!is_array($ids)) {
                $ids = [$ids];
            }

            Website::whereIn('id', $ids)->delete();

            return 'Success';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
