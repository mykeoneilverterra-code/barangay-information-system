<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResidentRequest;
use App\Http\Requests\UpdateResidentRequest;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            (string) $request->query(
                'search',
                ''
            )
        );

        $area = trim(
            (string) $request->query(
                'area',
                ''
            )
        );


        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $totalResidents =
            Resident::count();


        /*
        |--------------------------------------------------------------------------
        | Available Village / Street Areas
        |--------------------------------------------------------------------------
        */

        $areas =
            Resident::query()

                ->whereNotNull('area')

                ->where(
                    'area',
                    '!=',
                    ''
                )

                ->select('area')

                ->distinct()

                ->orderBy('area')

                ->pluck('area');


        /*
        |--------------------------------------------------------------------------
        | Search + Filter
        |--------------------------------------------------------------------------
        */

        $residents =
            Resident::query()

                ->when(
                    $search !== '',
                    function ($query) use ($search) {

                        $query->where(
                            function ($subQuery) use ($search) {

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
                                        [
                                            '%' . $search . '%'
                                        ]
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
                            }
                        );
                    }
                )

                ->when(
                    $area !== '',
                    function ($query) use ($area) {

                        $query->where(
                            'area',
                            $area
                        );
                    }
                )

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
        $areas =
            $this->areaOptions();


        /*
        |--------------------------------------------------------------------------
        | Preview Next Resident Number
        |--------------------------------------------------------------------------
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

    public function store(
        StoreResidentRequest $request
    ) {
        /*
        |--------------------------------------------------------------------------
        | Validated Data
        |--------------------------------------------------------------------------
        */

        $data =
            $request->validated();


        /*
        |--------------------------------------------------------------------------
        | Resident Number
        |--------------------------------------------------------------------------
        |
        | Resident Number remains system-generated.
        |
        */

        $data['resident_number'] =
            $this->generateResidentNumber();


        /*
        |--------------------------------------------------------------------------
        | Profile Photo
        |--------------------------------------------------------------------------
        */

        if (
            $request->hasFile(
                'profile_photo'
            )
        ) {

            $data['profile_photo_path'] =
                $request
                    ->file('profile_photo')
                    ->store(
                        'residents',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | Remove Temporary Upload Field
        |--------------------------------------------------------------------------
        |
        | The database column is profile_photo_path,
        | not profile_photo.
        |
        */

        unset(
            $data['profile_photo']
        );


        /*
        |--------------------------------------------------------------------------
        | Create Resident
        |--------------------------------------------------------------------------
        */

        $resident =
            Resident::create(
                $data
            );


        /*
        |--------------------------------------------------------------------------
        | Redirect
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

    public function show(
        Resident $resident
    ) {
        return view(
            'residents.show',
            compact(
                'resident'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit Resident
    |--------------------------------------------------------------------------
    */

    public function edit(
        Resident $resident
    ) {
        $areas =
            $this->areaOptions();


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
        UpdateResidentRequest $request,
        Resident $resident
    ) {
        /*
        |--------------------------------------------------------------------------
        | Validated Data
        |--------------------------------------------------------------------------
        */

        $data =
            $request->validated();


        /*
        |--------------------------------------------------------------------------
        | New Profile Photo
        |--------------------------------------------------------------------------
        */

        if (
            $request->hasFile(
                'profile_photo'
            )
        ) {

            /*
            |--------------------------------------------------------------------------
            | Delete Old Photo
            |--------------------------------------------------------------------------
            */

            if (
                $resident->profile_photo_path
                && Storage::disk('public')
                    ->exists(
                        $resident->profile_photo_path
                    )
            ) {

                Storage::disk('public')
                    ->delete(
                        $resident->profile_photo_path
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | Store New Photo
            |--------------------------------------------------------------------------
            */

            $data['profile_photo_path'] =
                $request
                    ->file('profile_photo')
                    ->store(
                        'residents',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | Remove Temporary Upload Field
        |--------------------------------------------------------------------------
        */

        unset(
            $data['profile_photo']
        );


        /*
        |--------------------------------------------------------------------------
        | Update Resident
        |--------------------------------------------------------------------------
        */

        $resident->update(
            $data
        );


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

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

    public function destroy(
        Resident $resident
    ) {
        /*
        |--------------------------------------------------------------------------
        | Delete Profile Photo
        |--------------------------------------------------------------------------
        */

        if (
            $resident->profile_photo_path
            && Storage::disk('public')
                ->exists(
                    $resident->profile_photo_path
                )
        ) {

            Storage::disk('public')
                ->delete(
                    $resident->profile_photo_path
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Resident
        |--------------------------------------------------------------------------
        */

        $resident->delete();


        return redirect()

            ->route(
                'residents.index'
            )

            ->with(
                'success',
                'Resident deleted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Automatically Generate Resident Number
    |--------------------------------------------------------------------------
    */

    private function generateResidentNumber(): string
    {
        $lastResidentNumber =
            Resident::query()

                ->where(
                    'resident_number',
                    'like',
                    'RES-%'
                )

                ->orderByRaw(
                    "CAST(SUBSTRING(resident_number, 5) AS UNSIGNED) DESC"
                )

                ->value(
                    'resident_number'
                );


        /*
        |--------------------------------------------------------------------------
        | If no residents exist
        |--------------------------------------------------------------------------
        */

        if (
            !$lastResidentNumber
        ) {

            $nextNumber = 1;

        } else {

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