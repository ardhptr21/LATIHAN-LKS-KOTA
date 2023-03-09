<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Studio;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    private function countPrice(array $studio, string $start)
    {
        $day = date('l', strtotime($start));
        $price = $studio['basic_price'];

        if ($day == 'Friday') {
            $price += $studio['additional_friday_price'];
        } elseif ($day == 'Saturday') {
            $price += $studio['additional_saturday_price'];
        } elseif ($day == 'Sunday') {
            $price += $studio['additional_sunday_price'];
        }

        return $price;
    }

    public function index(Request $request)
    {
        $studio_id = $request->query('edit');

        $branches = Branch::select('id', 'name')->get();

        if ($studio_id) {
            $studio = Studio::find($studio_id);
            if (!$studio) abort(404);

            return view('pages.studios.edit', compact('studio', 'branches'));
        }

        $studios_group = Studio::all()->groupBy('branch_id');
        return view('pages.studios.index', compact('branches', 'studios_group'));
    }

    public function store()
    {
        $data = request()->validate([
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required',
            'basic_price' => 'required|numeric|between:1,10000000',
            'additional_friday_price' => 'required|numeric|between:1,1000000',
            'additional_saturday_price' => 'required|numeric|between:1,1000000',
            'additional_sunday_price' => 'required|numeric|between:1,1000000',
        ]);

        $studio = Studio::create($data);

        if (!$studio) return back()->with('error', 'Create studio failed!');

        return back()->with('success', 'Create studio success!');
    }

    public function update(Request $request, Studio $studio)
    {
        $data = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required',
            'basic_price' => 'required|numeric|between:1,10000000',
            'additional_friday_price' => 'required|numeric|between:1,1000000',
            'additional_saturday_price' => 'required|numeric|between:1,1000000',
            'additional_sunday_price' => 'required|numeric|between:1,1000000',
        ]);

        $isSomePriceChanged = $studio->basic_price != $data['basic_price'] ||
            $studio->additional_friday_price != $data['additional_friday_price'] ||
            $studio->additional_saturday_price != $data['additional_saturday_price'] ||
            $studio->additional_sunday_price != $data['additional_sunday_price'];

        $updated = $studio->update($data);

        if ($isSomePriceChanged) {
            $studio->schedules()->get()->each(function ($schedule) use ($data) {
                $schedule->update(['price' => $this->countPrice($data, $schedule->start)]);
            });
        }

        if (!$updated) return back()->with('error', 'Update studio failed!');

        return to_route('studios.index')->with('success', 'Update studio success!');
    }

    public function destroy(Studio $studio)
    {
        $studio->delete();

        return back()->with('success', 'Delete studio success!');
    }
}
