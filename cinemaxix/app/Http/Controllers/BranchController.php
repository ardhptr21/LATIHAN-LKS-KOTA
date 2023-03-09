<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branch_id = request()->query('edit');

        if ($branch_id) {
            $branch = Branch::find($branch_id);
            if (!$branch) abort(404);

            return view('pages.branches.edit', compact('branch'));
        }

        $branches = Branch::withCount('studios')->get();

        return view('pages.branches.index', compact('branches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required']);

        $branch = Branch::create($validated);

        if (!$branch) return back()->with('error', 'Create branch failed!');

        return back()->with('success', 'Create branch success!');
    }

    public function update(Request $request, Branch $branch)
    {
        $validated = $request->validate(['name' => 'required']);

        $updated = $branch->update($validated);

        if (!$updated) return back()->with('error', 'Update branch failed!');

        return to_route('branches.index')->with('success', 'Update branch success!');
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();
        return back()->with('success', 'Delete branch success!');
    }
}
