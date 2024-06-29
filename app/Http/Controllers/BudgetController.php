<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class BudgetController extends Controller
{

    public function index()
    {
        $budgets = Budget::orderBy('created_at')->get()->toArray();
        return view('budget.index', [
            'title' => 'List Budget',
            'data' => $budgets
        ]);
    }

    public function create()
    {
        return view('budget.create', [
            'title' => 'Create Budget'
        ]);
    }

    public function view($id)
    {
        if (!is_array($id)) {
            $ids = [$id];
        }

        $response = Budget::whereIn('id', $ids)->get()->toArray();
        return view('budget.view', [
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

        $response = Budget::whereIn('id', $ids)->get()->toArray();
        return view('budget.update', [
            'title' => 'View Budget',
            'data' => $response
        ]);
    }

    public function update(Request $request)
    {
        try {

            $ids = $request->id;
            $budget = $request->budget;
            $nama_event = $request->nama_event;
            $jenis_event = $request->jenis_event;

            foreach ($ids as $i => $id) {
                Budget::where('id', $id)->update([
                    'budget' => $budget[$i],
                    'nama_event' => $nama_event[$i],
                    'jenis_event' => $jenis_event[$i]
                ]);
            }

            return redirect('/budget/index')->with('success', 'Data berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_event' => 'required|string|max:255',
            'jenis_event' => 'required|integer',
            'budget' => 'required|numeric',
        ]);

        try {
            $budget = new Budget();
            $budget->nama_event = $request->nama_event;
            $budget->jenis_event = $request->jenis_event;
            $budget->budget = $request->budget;

            $budget->save();

            return redirect('/budget/index')->with('success', 'Data budget berhasil disimpan.');
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

            Budget::whereIn('id', $ids)->delete();

            return 'Success';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
