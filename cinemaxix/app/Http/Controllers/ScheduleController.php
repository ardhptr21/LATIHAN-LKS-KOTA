<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Movie;
use App\Models\Schedule;
use App\Models\Studio;
use Illuminate\Http\Request;


class ScheduleController extends Controller
{
    private function countPrice(int $studio_id, string $start)
    {
        $studio = Studio::find($studio_id)->first();
        $day = date('l', strtotime($start));
        $price = $studio->basic_price;

        if ($day == 'Friday') {
            $price += $studio->additional_friday_price;
        } elseif ($day == 'Saturday') {
            $price += $studio->additional_saturday_price;
        } elseif ($day == 'Sunday') {
            $price += $studio->additional_sunday_price;
        }

        return $price;
    }

    public function index(Request $request)
    {
        $studios = Studio::select('id', 'name')->get();
        $movies = Movie::all();
        $branch = $request->query('branch');
        $date = $request->query('date');

        $studios_group = [];
        if ($branch) {
            $studios_group = Studio::where('branch_id', $branch)
                ->with(['schedules', 'schedules.movie'])
                ->get();

            if ($date) {
                $studios_group->filter(fn ($studio) => $studio
                    ->setRelation('schedules', $studio
                        ->schedules
                        ->where('start', '>=', $date . ' 00:00:00')
                        ->where('start', '<=', $date . ' 23:59:59')));
            }

            $studios_group = $studios_group->filter(fn ($studio) => $studio
                ->schedules
                ->isNotEmpty())
                ->map(fn ($studio) => $studio
                    ->setRelation('schedules', $studio
                        ->schedules
                        ->sortBy('start')
                        ->groupBy('movie_id')));
        }

        $branches = Branch::select('id', 'name')->get();
        return view('pages.schedules.index', compact('studios_group', 'movies', 'branches'));
    }

    public function admin(Request $request)
    {
        $studios = Studio::all(['id', 'name']);
        $movies = Movie::all(['id', 'name']);
        $schedules = Schedule::with(['movie', 'studio'])->get();
        $branches = Branch::select('id', 'name')->get();

        return view('pages.schedules.admin', compact('schedules', 'studios', 'movies', 'branches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'studio_id' => 'required|exists:studios,id',
            'movie_id' => 'required|exists:movies,id',
            'start' => 'required',
        ]);

        $movie = Movie::find($validated['movie_id'])->select('minute_length')->first();
        $validated['start'] = date('Y-m-d H:i:s', strtotime($validated['start']));
        $validated['end'] = date('Y-m-d H:i:s', strtotime($validated['start']) + ($movie->minute_length * 60));

        $validated['price'] = $this->countPrice($validated['studio_id'], $validated['start']);

        $schedule = Schedule::create($validated);

        if (!$schedule) return back()->with('error', 'Schedule create failed!');

        return back()->with('success', 'Schedule created success!');
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'studio_id' => 'required|exists:studios,id',
            'movie_id' => 'required|exists:movies,id',
            'start' => 'required',
        ]);

        $movie = Movie::find($validated['movie_id'])->select('minute_length')->first();
        $validated['start'] = date('Y-m-d H:i:s', strtotime($validated['start']));
        $validated['end'] = date('Y-m-d H:i:s', strtotime($validated['start']) + ($movie->minute_length * 60));

        $validated['price'] = $this->countPrice($validated['studio_id'], $validated['start']);

        $updated = $schedule->update($validated);

        if (!$updated) return back()->with('error', 'Schedule update failed!');

        return to_route('schedules.admin')->with('success', 'Schedule updated success!');
    }

    public function destroy(Schedule $schedule)
    {
        $destroyed = $schedule->delete();
        if (!$destroyed) return back()->with('error', 'Schedule delete failed!');
        return back()->with('success', 'Schedule deleted success!');
    }
}
