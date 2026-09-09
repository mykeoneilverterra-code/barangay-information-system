<?php

namespace App\Http\Controllers;

use App\Models\Household;
use Illuminate\Http\Request;

class HouseholdController extends Controller
{
    public function index()
    {
        $households = Household::orderBy('household_number')
                           ->paginate(10);

        return view('households.index', compact('households'));
    }

    public function create()
    {
        return view('households.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'household_number' => 'required|unique:households,household_number',
            'household_head' => 'required',
            'address' => 'required',
            'purok' => 'required',
            'contact_number' => 'nullable',
        ]);

        Household::create($request->all());

        return redirect()
            ->route('households.index')
            ->with('success', 'Household created successfully.');
    }

    public function show(Household $household)
    {
        $household->load('residents');

        return view('households.show', compact('household'));
    }

    public function edit(Household $household)
    {
        return view('households.edit', compact('household'));
    }

    public function update(Request $request, Household $household)
    {
        $request->validate([
            'household_number' => 'required|unique:households,household_number,' . $household->id,
            'household_head' => 'required',
            'address' => 'required',
            'purok' => 'required',
            'contact_number' => 'nullable',
        ]);

        $household->update($request->all());

        return redirect()
            ->route('households.index')
            ->with('success', 'Household updated successfully.');
    }

    public function destroy(Household $household)
    {
        $household->delete();

        return redirect()
            ->route('households.index')
            ->with('success', 'Household deleted successfully.');
    }
}