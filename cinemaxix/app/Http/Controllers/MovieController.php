<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $movie_id = $request->query('edit');

        if ($movie_id) {
            $movie = Movie::find($movie_id);
            if (!$movie) abort(404);

            return view('pages.movies.edit', compact('movie'));
        }

        $movies = Movie::all();
        return view('pages.movies.index', compact('movies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'minute_length' => 'required|integer|between:1,999',
            'picture' => 'required|file|image|max:2048',
        ]);

        $picture = $request->file('picture');
        [$width, $height] = getimagesize($picture->path());
        if (abs(($width / $height) - (2 / 3)) > 0.15) return back()->withErrors(['picture' => 'The picture aspect ratio must be 2:3!']);

        $picture_url = $picture->store('public/movies');

        if (!$picture_url) return back()->withErrors(['picture' => 'Upload picture failed!']);

        $validated['picture_url'] = url(str_replace('public', 'storage', $picture_url));

        $movie = Movie::create($validated);

        if (!$movie) return back()->with('error', 'Create movie failed!');

        return back()->with('success', 'Create movie success!');
    }

    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'minute_length' => 'required|integer',
            'picture' => 'nullable|file|image|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            [$width, $height] = getimagesize($picture->path());
            if (abs(($width / $height) - (2 / 3)) > 0.15) return back()->withErrors(['picture' => 'The picture aspect ratio must be 2:3!']);

            $picture_url = $picture->store('public/movies');

            if (!$picture_url) return back()->withErrors(['picture' => 'Upload picture failed!']);

            $old_picture_url = str_replace('storage', 'public', $movie->picture_url);
            $old_picture_url = str_replace($request->getSchemeAndHttpHost(), '/', $old_picture_url);
            Storage::delete($old_picture_url);

            $validated['picture_url'] = url(str_replace('public', 'storage', $picture_url));
        }

        $updated = $movie->update($validated);

        if (!$updated) return back()->with('error', 'Update movie failed!');

        return to_route('movies.index')->with('success', 'Update movie success!');
    }

    public function destroy(Request $request, Movie $movie)
    {
        $old_picture_url = str_replace('storage', 'public', $movie->picture_url);
        $old_picture_url = str_replace($request->getSchemeAndHttpHost(), '/', $old_picture_url);

        $deleted = $movie->delete();

        if (!$deleted) return back()->with('error', 'Delete movie failed!');

        Storage::delete($old_picture_url);

        return back()->with('success', 'Delete movie success!');
    }
}
