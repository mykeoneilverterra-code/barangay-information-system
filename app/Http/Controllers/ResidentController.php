<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Household;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Display Resident Records
    |--------------------------------------------------------------------------
    |
    | Handles:
    | - Resident listing
    | - Search
    | - Village / Street filtering
    | - Pagination
    |
    */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Search and Filter Values
        |--------------------------------------------------------------------------
        */

        $search = trim((string) $request->query('search', ''));

        $area = trim((string) $request->query('area', ''));


        /*
        |--------------------------------------------------------------------------
        | Total Resident Count
        |--------------------------------------------------------------------------
        */

        $totalResidents = Resident::count();


        /*
        |--------------------------------------------------------------------------
        | Village / Street Options
        |--------------------------------------------------------------------------
        |
        | Areas are stored in households.
        |
        */

        $areas = Household::query()
            ->whereNotNull('area')
            ->where('area', '!=', '')
            ->select('area')
            ->distinct()
            ->orderBy('area')
            ->pluck('area');


        /*
        |--------------------------------------------------------------------------
        | Resident Query
        |--------------------------------------------------------------------------
        */

        $residents = Resident::query()

            ->with('household')


            /*
            |--------------------------------------------------------------------------
            | Search
            |--------------------------------------------------------------------------
            |
            | Searchable:
            | - Resident number
            | - First name
            | - Middle name
            | - Last name
            | - Full name
            | - Contact number
            | - Email
            | - Occupation
            | - Household number
            | - Household address
            | - Village / Street
            |
            */

            ->when($search !== '', function ($query) use ($search) {

                $query->where(function ($subQuery) use ($search) {

                    $subQuery

                        ->where(
                            'resident_number',
                            'like',
                            '%' . $search . '%'
                        )

                        ->orWhere(
                            'first_name',
                            'like',
                            '%' . $search . '%'
                        )

                        ->orWhere(
                            'middle_name',
                            'like',
                            '%' . $search . '%'
                        )

                        ->orWhere(
                            'last_name',
                            'like',
                            '%' . $search . '%'
                        )

                        ->orWhere(
                            'contact_number',
                            'like',
                            '%' . $search . '%'
                        )

                        ->orWhere(
                            'email',
                            'like',
                            '%' . $search . '%'
                        )

                        ->orWhere(
                            'occupation',
                            'like',
                            '%' . $search . '%'
                        )

                        ->orWhereRaw(
                            "CONCAT_WS(' ', first_name, middle_name, last_name, suffix) LIKE ?",
                            ['%' . $search . '%']
                        )

                        ->orWhereHas(
                            'household',
                            function ($householdQuery) use ($search) {

                                $householdQuery

                                    ->where(
                                        'household_number',
                                        'like',
                                        '%' . $search . '%'
                                    )

                                    ->orWhere(
                                        'address',
                                        'like',
                                        '%' . $search . '%'
                                    )

                                    ->orWhere(
                                        'area',
                                        'like',
                                        '%' . $search . '%'
                                    );
                            }
                        );
                });
            })


            /*
            |--------------------------------------------------------------------------
            | Village / Street Filter
            |--------------------------------------------------------------------------
            */

            ->when($area !== '', function ($query) use ($area) {

                $query->whereHas(
                    'household',
                    function ($householdQuery) use ($area) {

                        $householdQuery->where(
                            'area',
                            $area
                        );
                    }
                );
            })


            /*
            |--------------------------------------------------------------------------
            | Sorting
            |--------------------------------------------------------------------------
            */

            ->orderBy('last_name', 'asc')
            ->orderBy('first_name', 'asc')


            /*
            |--------------------------------------------------------------------------
            | Pagination
            |--------------------------------------------------------------------------
            */

            ->paginate(10)

            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Return Resident Page
        |--------------------------------------------------------------------------
        */

        return view(
            'residents.index',
            compact(
                'residents',
                'areas',
                'totalResidents',
                'search',
                'area'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Add Resident Form
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $households = Household::orderBy(
            'household_number'
        )->get();

        return view(
            'residents.create',
            compact('households')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store Resident
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $data = $request->validate([

            'resident_number' =>
                'required|string|max:20|unique:residents',

            'first_name' =>
                'required|string|max:60',

            'middle_name' =>
                'nullable|string|max:60',

            'last_name' =>
                'required|string|max:60',

            'suffix' =>
                'nullable|string|max:20',

            'sex' =>
                'required|string|max:20',

            'birth_date' =>
                'required|date',

            'civil_status' =>
                'required|string|max:30',

            'contact_number' =>
                'nullable|string|max:20',

            'email' =>
                'nullable|email|unique:residents',

            'occupation' =>
                'nullable|string|max:100',

            'is_voter' =>
                'nullable|boolean',

            'is_household_head' =>
                'nullable|boolean',

            'household_id' =>
                'required|exists:households,id',
        ]);


        $data['is_voter'] =
            $request->boolean('is_voter');

        $data['is_household_head'] =
            $request->boolean('is_household_head');


        Resident::create($data);


        return redirect()
            ->route('residents.index')
            ->with(
                'success',
                'Resident added successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Resident Details
    |--------------------------------------------------------------------------
    */

    public function show(Resident $resident)
    {
        $resident->load('household');


        return view(
            'residents.show',
            compact('resident')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Edit Resident Form
    |--------------------------------------------------------------------------
    */

    public function edit(Resident $resident)
    {
        $households = Household::orderBy(
            'household_number'
        )->get();


        return view(
            'residents.edit',
            compact(
                'resident',
                'households'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Resident
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Resident $resident
    ) {
        $data = $request->validate([

            'resident_number' =>
                'required|string|max:20|unique:residents,resident_number,'
                . $resident->id,

            'first_name' =>
                'required|string|max:60',

            'middle_name' =>
                'nullable|string|max:60',

            'last_name' =>
                'required|string|max:60',

            'suffix' =>
                'nullable|string|max:20',

            'sex' =>
                'required|string|max:20',

            'birth_date' =>
                'required|date',

            'civil_status' =>
                'required|string|max:30',

            'contact_number' =>
                'nullable|string|max:20',

            'email' =>
                'nullable|email|unique:residents,email,'
                . $resident->id,

            'occupation' =>
                'nullable|string|max:100',

            'is_voter' =>
                'nullable|boolean',

            'is_household_head' =>
                'nullable|boolean',

            'household_id' =>
                'required|exists:households,id',
        ]);


        $data['is_voter'] =
            $request->boolean('is_voter');

        $data['is_household_head'] =
            $request->boolean('is_household_head');


        $resident->update($data);


        return redirect()
            ->route('residents.index')
            ->with(
                'success',
                'Resident updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Resident
    |--------------------------------------------------------------------------
    */

    public function destroy(Resident $resident)
    {
        $resident->delete();


        return redirect()
            ->route('residents.index')
            ->with(
                'success',
                'Resident deleted successfully.'
            );
    }
}