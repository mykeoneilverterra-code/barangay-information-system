<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResidentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Resident Directory
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $search = trim(
            (string) $request->query('search', '')
        );

        $area = trim(
            (string) $request->query('area', '')
        );


        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $totalResidents = Resident::count();


        /*
        |--------------------------------------------------------------------------
        | Available Village / Street Areas
        |--------------------------------------------------------------------------
        */

        $areas = Resident::query()
            ->whereNotNull('area')
            ->where('area', '!=', '')
            ->select('area')
            ->distinct()
            ->orderBy('area')
            ->pluck('area');


        /*
        |--------------------------------------------------------------------------
        | Search + Filter
        |--------------------------------------------------------------------------
        */

        $residents = Resident::query()

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

                        ->orWhereRaw(
                            "CONCAT_WS(' ', first_name, middle_name, last_name, suffix) LIKE ?",
                            ['%' . $search . '%']
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
                            'occupation',
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
                        );
                });
            })

            ->when($area !== '', function ($query) use ($area) {

                $query->where(
                    'area',
                    $area
                );
            })

            ->orderBy('last_name')
            ->orderBy('first_name')

            ->paginate(10)
            ->withQueryString();


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
    | Add Resident
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $areas = $this->areaOptions();

        /*
        |--------------------------------------------------------------------------
        | Preview Next Resident Number
        |--------------------------------------------------------------------------
        |
        | Display only. The actual number is generated again during save.
        |
        */

        $nextResidentNumber =
            $this->generateResidentNumber();


        return view(
            'residents.create',
            compact(
                'areas',
                'nextResidentNumber'
            )
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

            'first_name' => [
                'required',
                'string',
                'max:60',
            ],

            'middle_name' => [
                'nullable',
                'string',
                'max:60',
            ],

            'last_name' => [
                'required',
                'string',
                'max:60',
            ],

            'suffix' => [
                'nullable',
                'string',
                'max:20',
            ],

            'sex' => [
                'required',
                'string',
                'max:20',
            ],

            'birth_date' => [
                'required',
                'date',
            ],

            'civil_status' => [
                'required',
                'string',
                'max:30',
            ],

            'contact_number' => [
                'nullable',
                'string',
                'max:20',
            ],

            'email' => [
                'nullable',
                'email',
                'unique:residents,email',
            ],

            'occupation' => [
                'nullable',
                'string',
                'max:100',
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

            'is_voter' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Automatically Generate Resident Number
        |--------------------------------------------------------------------------
        */

        $data['resident_number'] =
            $this->generateResidentNumber();


        /*
        |--------------------------------------------------------------------------
        | Checkbox
        |--------------------------------------------------------------------------
        */

        $data['is_voter'] =
            $request->boolean('is_voter');


        /*
        |--------------------------------------------------------------------------
        | Create Resident
        |--------------------------------------------------------------------------
        */

        $resident = Resident::create($data);


        /*
        |--------------------------------------------------------------------------
        | Redirect to Resident Details
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'residents.show',
                $resident
            )
            ->with(
                'success',
                'Resident registered successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Resident Details
    |--------------------------------------------------------------------------
    */

    public function show(Resident $resident)
    {
        return view(
            'residents.show',
            compact('resident')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit Resident
    |--------------------------------------------------------------------------
    */

    public function edit(Resident $resident)
    {
        $areas = $this->areaOptions();

        return view(
            'residents.edit',
            compact(
                'resident',
                'areas'
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

            /*
            |--------------------------------------------------------------------------
            | Resident Number is intentionally NOT editable.
            |--------------------------------------------------------------------------
            */

            'first_name' => [
                'required',
                'string',
                'max:60',
            ],

            'middle_name' => [
                'nullable',
                'string',
                'max:60',
            ],

            'last_name' => [
                'required',
                'string',
                'max:60',
            ],

            'suffix' => [
                'nullable',
                'string',
                'max:20',
            ],

            'sex' => [
                'required',
                'string',
                'max:20',
            ],

            'birth_date' => [
                'required',
                'date',
            ],

            'civil_status' => [
                'required',
                'string',
                'max:30',
            ],

            'contact_number' => [
                'nullable',
                'string',
                'max:20',
            ],

            'email' => [
                'nullable',
                'email',

                Rule::unique(
                    'residents',
                    'email'
                )->ignore($resident->id),
            ],

            'occupation' => [
                'nullable',
                'string',
                'max:100',
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

            'is_voter' => [
                'nullable',
                'boolean',
            ],
        ]);


        $data['is_voter'] =
            $request->boolean('is_voter');


        $resident->update($data);


        return redirect()
            ->route(
                'residents.show',
                $resident
            )
            ->with(
                'success',
                'Resident information updated successfully.'
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


    /*
    |--------------------------------------------------------------------------
    | Automatically Generate Resident Number
    |--------------------------------------------------------------------------
    |
    | Example:
    |
    | RES-00040
    |     ↓
    | RES-00041
    |
    */

    private function generateResidentNumber(): string
    {
        $lastResidentNumber = Resident::query()

            ->where(
                'resident_number',
                'like',
                'RES-%'
            )

            ->orderByRaw(
                "CAST(SUBSTRING(resident_number, 5) AS UNSIGNED) DESC"
            )

            ->value('resident_number');


        /*
        |--------------------------------------------------------------------------
        | If no residents exist yet
        |--------------------------------------------------------------------------
        */

        if (!$lastResidentNumber) {

            $nextNumber = 1;

        } else {

            /*
            |--------------------------------------------------------------------------
            | Remove "RES-" and convert the remaining part to a number
            |--------------------------------------------------------------------------
            */

            $lastNumber =
                (int) substr(
                    $lastResidentNumber,
                    4
                );


            $nextNumber =
                $lastNumber + 1;
        }


        return 'RES-'
            . str_pad(
                $nextNumber,
                5,
                '0',
                STR_PAD_LEFT
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Barangay San Antonio Village / Street Options
    |--------------------------------------------------------------------------
    */

    private function areaOptions(): array
    {
        return [
            'St. Rose Village 3',
            'Jubilation Amanzaya East',
            'Jubilation Central',
            'Villagio de Xavier',
            'St. Francis Subdivision VII',
            'St. Anthony Village',
            'Villa San Antonio',
            'Sta. Catalina',
            'U. Ambasa',
            'Umboy',
        ];
    }
}