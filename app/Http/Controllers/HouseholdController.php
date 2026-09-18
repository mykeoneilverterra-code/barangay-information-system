<?php

namespace App\Http\Controllers;

use App\Models\Household;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HouseholdController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Display Household Records
    |--------------------------------------------------------------------------
    |
    | Handles:
    | - Household listing
    | - Search
    | - Village / Street filtering
    | - Pagination
    |
    */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Get Search and Filter Values
        |--------------------------------------------------------------------------
        */

        $search = trim((string) $request->query('search', ''));

        $area = trim((string) $request->query('area', ''));


        /*
        |--------------------------------------------------------------------------
        | Total Household Count
        |--------------------------------------------------------------------------
        |
        | This remains the total number of households even if a filter
        | or search is currently active.
        |
        */

        $totalHouseholds = Household::count();


        /*
        |--------------------------------------------------------------------------
        | Get Available Villages / Streets
        |--------------------------------------------------------------------------
        |
        | These values will be used inside the dropdown filter.
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
        | Household Query
        |--------------------------------------------------------------------------
        */

        $households = Household::query()


            /*
            |--------------------------------------------------------------------------
            | Search
            |--------------------------------------------------------------------------
            |
            | Searchable fields:
            | - Household number
            | - Household head
            | - Complete address
            | - Village / Street
            | - Contact number
            |
            */

            ->when($search !== '', function ($query) use ($search) {

                $query->where(function ($subQuery) use ($search) {

                    $subQuery

                        ->where(
                            'household_number',
                            'like',
                            '%' . $search . '%'
                        )

                        ->orWhere(
                            'household_head',
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
                        )

                        ->orWhere(
                            'contact_number',
                            'like',
                            '%' . $search . '%'
                        );
                });
            })


            /*
            |--------------------------------------------------------------------------
            | Village / Street Filter
            |--------------------------------------------------------------------------
            */

            ->when($area !== '', function ($query) use ($area) {

                $query->where(
                    'area',
                    $area
                );
            })


            /*
            |--------------------------------------------------------------------------
            | Sorting
            |--------------------------------------------------------------------------
            */

            ->orderBy(
                'household_number',
                'asc'
            )


            /*
            |--------------------------------------------------------------------------
            | Pagination
            |--------------------------------------------------------------------------
            */

            ->paginate(10)

            /*
            |--------------------------------------------------------------------------
            | Preserve Search / Filter During Pagination
            |--------------------------------------------------------------------------
            */

            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Return Household Page
        |--------------------------------------------------------------------------
        */

        return view(
            'households.index',
            compact(
                'households',
                'areas',
                'totalHouseholds',
                'search',
                'area'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Add Household Form
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('households.create');
    }


    /*
    |--------------------------------------------------------------------------
    | Store New Household
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'household_number' => [
                'required',
                'string',
                'max:50',
                'unique:households,household_number',
            ],

            'household_head' => [
                'required',
                'string',
                'max:255',
            ],

            'address' => [
                'required',
                'string',
                'max:500',
            ],

            'area' => [
                'required',
                'string',
                'max:255',
            ],

            'contact_number' => [
                'nullable',
                'string',
                'max:20',
            ],

        ]);


        Household::create($validated);


        return redirect()
            ->route('households.index')
            ->with(
                'success',
                'Household added successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Household Details
    |--------------------------------------------------------------------------
    */

    public function show(Household $household)
    {
        $household->load('residents');


        return view(
            'households.show',
            compact('household')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Edit Household Form
    |--------------------------------------------------------------------------
    */

    public function edit(Household $household)
    {
        return view(
            'households.edit',
            compact('household')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Household
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Household $household
    ) {
        $validated = $request->validate([

            'household_number' => [
                'required',
                'string',
                'max:50',

                Rule::unique(
                    'households',
                    'household_number'
                )->ignore($household->id),
            ],

            'household_head' => [
                'required',
                'string',
                'max:255',
            ],

            'address' => [
                'required',
                'string',
                'max:500',
            ],

            'area' => [
                'required',
                'string',
                'max:255',
            ],

            'contact_number' => [
                'nullable',
                'string',
                'max:20',
            ],

        ]);


        $household->update($validated);


        return redirect()
            ->route('households.index')
            ->with(
                'success',
                'Household updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Household
    |--------------------------------------------------------------------------
    */

    public function destroy(Household $household)
    {
        $household->delete();


        return redirect()
            ->route('households.index')
            ->with(
                'success',
                'Household deleted successfully.'
            );
    }
}