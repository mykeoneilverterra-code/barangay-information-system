@csrf


{{-- =========================================================
    PERSONAL INFORMATION
========================================================= --}}
<section class="resident-form-section">

    <div class="resident-form-section-header">

        <div class="form-section-icon">
            01
        </div>

        <div>

            <h3>
                Personal Information
            </h3>

            <p>
                Enter the resident's basic personal information.
            </p>

        </div>

    </div>


    <div class="resident-form-grid">


        {{-- Resident Number --}}
        <div class="form-field">

            <label>
                Resident Number
            </label>

            <div class="generated-id-field">

                <span class="generated-id-icon">
                    #
                </span>

                <span class="generated-id-value">

                    @if(isset($resident))

                        {{ $resident->resident_number }}

                    @else

                        {{ $nextResidentNumber }}

                    @endif

                </span>

                <span class="generated-id-badge">
                    Auto-generated
                </span>

            </div>

            <div class="field-helper">
                Resident numbers are assigned automatically by the system.
            </div>

        </div>


        {{-- Birth Date --}}
        <div class="form-field">

            <label for="birth_date">

                Birth Date

                <span class="required-mark">
                    *
                </span>

            </label>

            <input
                type="date"
                name="birth_date"
                id="birth_date"
                class="form-control @error('birth_date') is-invalid @enderror"
                value="{{ old(
                    'birth_date',
                    isset($resident) && $resident->birth_date
                        ? $resident->birth_date->format('Y-m-d')
                        : ''
                ) }}"
                required
            >

            @error('birth_date')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>


        {{-- First Name --}}
        <div class="form-field">

            <label for="first_name">

                First Name

                <span class="required-mark">
                    *
                </span>

            </label>

            <input
                type="text"
                name="first_name"
                id="first_name"
                class="form-control @error('first_name') is-invalid @enderror"
                value="{{ old(
                    'first_name',
                    $resident->first_name ?? ''
                ) }}"
                placeholder="Example: Juan Miguel"
                required
            >

            @error('first_name')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>


        {{-- Sex --}}
        <div class="form-field">

            <label for="sex">

                Sex

                <span class="required-mark">
                    *
                </span>

            </label>

            <select
                name="sex"
                id="sex"
                class="form-select @error('sex') is-invalid @enderror"
                required
            >

                <option value="">
                    Select sex
                </option>

                <option
                    value="Male"
                    @selected(
                        old(
                            'sex',
                            $resident->sex ?? ''
                        ) === 'Male'
                    )
                >
                    Male
                </option>

                <option
                    value="Female"
                    @selected(
                        old(
                            'sex',
                            $resident->sex ?? ''
                        ) === 'Female'
                    )
                >
                    Female
                </option>

            </select>

            @error('sex')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>


        {{-- Middle Name --}}
        <div class="form-field">

            <label for="middle_name">

                Middle Name

                <span class="optional-label">
                    Optional
                </span>

            </label>

            <input
                type="text"
                name="middle_name"
                id="middle_name"
                class="form-control @error('middle_name') is-invalid @enderror"
                value="{{ old(
                    'middle_name',
                    $resident->middle_name ?? ''
                ) }}"
                placeholder="Example: Reyes"
            >

            @error('middle_name')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>


        {{-- Civil Status --}}
        <div class="form-field">

            <label for="civil_status">

                Civil Status

                <span class="required-mark">
                    *
                </span>

            </label>

            <select
                name="civil_status"
                id="civil_status"
                class="form-select @error('civil_status') is-invalid @enderror"
                required
            >

                <option value="">
                    Select civil status
                </option>

                @foreach([
                    'Single',
                    'Married',
                    'Widowed',
                    'Separated'
                ] as $status)

                    <option
                        value="{{ $status }}"
                        @selected(
                            old(
                                'civil_status',
                                $resident->civil_status ?? ''
                            ) === $status
                        )
                    >
                        {{ $status }}
                    </option>

                @endforeach

            </select>

            @error('civil_status')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>


        {{-- Last Name --}}
        <div class="form-field">

            <label for="last_name">

                Last Name

                <span class="required-mark">
                    *
                </span>

            </label>

            <input
                type="text"
                name="last_name"
                id="last_name"
                class="form-control @error('last_name') is-invalid @enderror"
                value="{{ old(
                    'last_name',
                    $resident->last_name ?? ''
                ) }}"
                placeholder="Example: Santos"
                required
            >

            @error('last_name')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>


        {{-- Suffix --}}
        <div class="form-field">

            <label for="suffix">

                Suffix

                <span class="optional-label">
                    Optional
                </span>

            </label>

            <input
                type="text"
                name="suffix"
                id="suffix"
                class="form-control @error('suffix') is-invalid @enderror"
                value="{{ old(
                    'suffix',
                    $resident->suffix ?? ''
                ) }}"
                placeholder="Example: Jr., Sr., III"
            >

            @error('suffix')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>

    </div>

</section>



{{-- =========================================================
    CONTACT & OCCUPATION
========================================================= --}}
<section class="resident-form-section">

    <div class="resident-form-section-header">

        <div class="form-section-icon">
            02
        </div>

        <div>

            <h3>
                Contact & Occupation
            </h3>

            <p>
                Add the resident's contact and employment information.
            </p>

        </div>

    </div>


    <div class="resident-form-grid">


        {{-- Contact Number --}}
        <div class="form-field">

            <label for="contact_number">

                Contact Number

                <span class="optional-label">
                    Optional
                </span>

            </label>

            <input
                type="text"
                name="contact_number"
                id="contact_number"
                class="form-control @error('contact_number') is-invalid @enderror"
                value="{{ old(
                    'contact_number',
                    $resident->contact_number ?? ''
                ) }}"
                placeholder="Example: 0917 123 4567"
            >

            <div class="field-helper">
                Philippine mobile number only. Spaces and hyphens are allowed.
            </div>

            @error('contact_number')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>


        {{-- Email --}}
        <div class="form-field">

            <label for="email">

                Email Address

                <span class="optional-label">
                    Optional
                </span>

            </label>

            <input
                type="email"
                name="email"
                id="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old(
                    'email',
                    $resident->email ?? ''
                ) }}"
                placeholder="Example: resident@email.com"
            >

            @error('email')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>


        {{-- Occupation --}}
        <div class="form-field form-field-full">

            <label for="occupation">

                Occupation

                <span class="optional-label">
                    Optional
                </span>

            </label>

            <input
                type="text"
                name="occupation"
                id="occupation"
                class="form-control @error('occupation') is-invalid @enderror"
                value="{{ old(
                    'occupation',
                    $resident->occupation ?? ''
                ) }}"
                placeholder="Example: Teacher, Student, Office Staff"
            >

            @error('occupation')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>

    </div>

</section>



{{-- =========================================================
    LOCATION INFORMATION
========================================================= --}}
<section class="resident-form-section">

    <div class="resident-form-section-header">

        <div class="form-section-icon">
            03
        </div>

        <div>

            <h3>
                Location Information
            </h3>

            <p>
                Register the resident's current address within Barangay San Antonio.
            </p>

        </div>

    </div>


    <div class="resident-form-grid">


        {{-- Village / Street --}}
        <div class="form-field form-field-full">

            <label for="area">

                Village / Street

                <span class="required-mark">
                    *
                </span>

            </label>

            <select
                name="area"
                id="area"
                class="form-select @error('area') is-invalid @enderror"
                required
            >

                <option value="">
                    Select Village / Street
                </option>

                @foreach($areas as $areaOption)

                    <option
                        value="{{ $areaOption }}"
                        @selected(
                            old(
                                'area',
                                $resident->area ?? ''
                            ) === $areaOption
                        )
                    >
                        {{ $areaOption }}
                    </option>

                @endforeach

            </select>

            @error('area')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>


        {{-- Complete Address --}}
        <div class="form-field form-field-full">

            <label for="address">

                Complete Address

                <span class="required-mark">
                    *
                </span>

            </label>

            <input
                type="text"
                name="address"
                id="address"
                class="form-control @error('address') is-invalid @enderror"
                value="{{ old(
                    'address',
                    $resident->address ?? ''
                ) }}"
                placeholder="Example: Blk 4 Lot 12, St. Rose Village 3, Brgy. San Antonio, Biñan, Laguna"
                required
            >

            <div class="field-helper">
                Include house number or Block/Lot and Barangay San Antonio, Biñan, Laguna.
            </div>

            @error('address')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>

    </div>


    {{-- Voter Status --}}
    <div class="resident-status-options single-status-option">

        <label
            class="resident-status-card"
            for="is_voter"
        >

            <input
                type="hidden"
                name="is_voter"
                value="0"
            >

            <input
                type="checkbox"
                name="is_voter"
                id="is_voter"
                value="1"
                class="resident-status-checkbox"
                @checked(
                    old(
                        'is_voter',
                        $resident->is_voter ?? false
                    )
                )
            >

            <span class="status-check-box">
                ✓
            </span>

            <span class="status-option-content">

                <strong>
                    Registered Voter
                </strong>

                <small>
                    Mark this resident if registered to vote.
                </small>

            </span>

        </label>

        @error('is_voter')

            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>

        @enderror

    </div>

</section>



{{-- =========================================================
    PROFILE PHOTO
========================================================= --}}
<section class="resident-form-section">

    <div class="resident-form-section-header">

        <div class="form-section-icon">
            04
        </div>

        <div>

            <h3>
                Profile Photo
            </h3>

            <p>
                Add an optional photo for the resident profile.
            </p>

        </div>

    </div>


    <div class="resident-photo-upload-layout">


        {{-- Current / Placeholder Photo --}}
        <div class="resident-photo-preview">

            @if(
                isset($resident)
                && $resident->profile_photo_path
            )

                <img
                    src="{{ asset(
                        'storage/'
                        . $resident->profile_photo_path
                    ) }}"
                    alt="{{ $resident->full_name }}"
                    class="resident-photo-preview-image"
                    id="resident-photo-preview-image"
                >

                <div
                    class="resident-photo-placeholder"
                    id="resident-photo-placeholder"
                    style="display: none;"
                >
                    {{ strtoupper(
                        substr(
                            $resident->first_name,
                            0,
                            1
                        )
                    ) }}
                </div>

            @else

                <img
                    src=""
                    alt="Resident photo preview"
                    class="resident-photo-preview-image"
                    id="resident-photo-preview-image"
                    style="display: none;"
                >

                <div
                    class="resident-photo-placeholder"
                    id="resident-photo-placeholder"
                >
                    {{ isset($resident)
                        ? strtoupper(
                            substr(
                                $resident->first_name,
                                0,
                                1
                            )
                        )
                        : '+'
                    }}
                </div>

            @endif

        </div>


        {{-- Upload Field --}}
        <div class="resident-photo-upload-content">

            <div class="form-field">

                <label for="profile_photo">

                    Resident Photo

                    <span class="optional-label">
                        Optional
                    </span>

                </label>

                <input
                    type="file"
                    name="profile_photo"
                    id="profile_photo"
                    class="form-control @error('profile_photo') is-invalid @enderror"
                    accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                >

                <div class="field-helper">
                    JPG, JPEG, or PNG only. Maximum file size is 2 MB.
                </div>

                @if(
                    isset($resident)
                    && $resident->profile_photo_path
                )

                    <div class="current-photo-note">
                        A profile photo is currently saved. Uploading a new image will replace it.
                    </div>

                @endif

                @error('profile_photo')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    PHOTO PREVIEW SCRIPT
========================================================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const input =
        document.getElementById('profile_photo');

    const image =
        document.getElementById(
            'resident-photo-preview-image'
        );

    const placeholder =
        document.getElementById(
            'resident-photo-placeholder'
        );


    if (!input || !image || !placeholder) {
        return;
    }


    input.addEventListener(
        'change',
        function (event) {

            const file =
                event.target.files[0];


            if (!file) {
                return;
            }


            const reader =
                new FileReader();


            reader.onload =
                function (loadEvent) {

                    image.src =
                        loadEvent.target.result;

                    image.style.display =
                        'block';

                    placeholder.style.display =
                        'none';
                };


            reader.readAsDataURL(
                file
            );
        }
    );

});
</script>