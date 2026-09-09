<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Household;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    public function index()
    {
        $residents = Resident::with('household')
                             ->orderBy('last_name')
                             ->paginate(10);

        return view('residents.index', compact('residents'));
    }

    public function create()
    {
        $households = Household::orderBy('household_number')->get();

        return view('residents.create', compact('households'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'resident_number' => 'required|string|max:20|unique:residents',
            'first_name'      => 'required|string|max:60',
            'middle_name'     => 'nullable|string|max:60',
            'last_name'       => 'required|string|max:60',
            'suffix'          => 'nullable|string|max:20',
            'sex'             => 'required|string|max:20',
            'birth_date'      => 'required|date',
            'civil_status'    => 'required|string|max:30',
            'contact_number'  => 'nullable|string|max:20',
            'email'           => 'nullable|email|unique:residents',
            'occupation'      => 'nullable|string|max:100',
            'is_voter'        => 'nullable|boolean',
            'is_household_head' => 'nullable|boolean',
            'household_id'    => 'required|exists:households,id',
        ]);

        $data['is_voter'] = $request->boolean('is_voter');
        $data['is_household_head'] = $request->boolean('is_household_head');

        Resident::create($data);

        return redirect()->route('residents.index')
                         ->with('success', 'Resident added.');
    }

    public function show(Resident $resident)
    {
        $resident->load('household');

        return view('residents.show', compact('resident'));
    }

    public function edit(Resident $resident)
    {
        $households = Household::orderBy('household_number')->get();

        return view('residents.edit', compact('resident', 'households'));
    }

    public function update(Request $request, Resident $resident)
    {
        $data = $request->validate([
            'resident_number' => 'required|string|max:20|unique:residents,resident_number,' . $resident->id,
            'first_name'      => 'required|string|max:60',
            'middle_name'     => 'nullable|string|max:60',
            'last_name'       => 'required|string|max:60',
            'suffix'          => 'nullable|string|max:20',
            'sex'             => 'required|string|max:20',
            'birth_date'      => 'required|date',
            'civil_status'    => 'required|string|max:30',
            'contact_number'  => 'nullable|string|max:20',
            'email'           => 'nullable|email|unique:residents,email,' . $resident->id,
            'occupation'      => 'nullable|string|max:100',
            'is_voter'        => 'nullable|boolean',
            'is_household_head' => 'nullable|boolean',
            'household_id'    => 'required|exists:households,id',
        ]);

        $data['is_voter'] = $request->boolean('is_voter');
        $data['is_household_head'] = $request->boolean('is_household_head');

        $resident->update($data);

        return redirect()->route('residents.index')
                         ->with('success', 'Resident updated.');
    }

    public function destroy(Resident $resident)
    {
        $resident->delete();

        return redirect()->route('residents.index')
                         ->with('success', 'Resident deleted.');
    }
}