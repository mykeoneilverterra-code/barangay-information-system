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
            <h3>Personal Information</h3>

            <p>
                Enter the resident's basic personal information.
            </p>
        </div>

    </div>


    <div class="resident-form-grid">


        {{-- Resident Number --}}
        <div class="form-field">

            <label for="resident_number">
                Resident Number
                <span class="required-mark">*</span>
            </label>

            <input
                type="text"
                name="resident_number"
                id="resident_number"
                class="form-control @error('resident_number') is-invalid @enderror"
                value="{{ old('resident_number', $resident->resident_number ?? '') }}"
                placeholder="Example: RES-00041"
                required
            >

            @error('resident_number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- Birth Date --}}
        <div class="form-field">

            <label for="birth_date">
                Birth Date
                <span class="required-mark">*</span>
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
                <span class="required-mark">*</span>
            </label>

            <input
                type="text"
                name="first_name"
                id="first_name"
                class="form-control @error('first_name') is-invalid @enderror"
                value="{{ old('first_name', $resident->first_name ?? '') }}"
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
                <span class="required-mark">*</span>
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
                value="{{ old('middle_name', $resident->middle_name ?? '') }}"
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
                <span class="required-mark">*</span>
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
                <span class="required-mark">*</span>
            </label>

            <input
                type="text"
                name="last_name"
                id="last_name"
                class="form-control @error('last_name') is-invalid @enderror"
                value="{{ old('last_name', $resident->last_name ?? '') }}"
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
                value="{{ old('suffix', $resident->suffix ?? '') }}"
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
            <h3>Contact & Occupation</h3>

            <p>
                Add contact details and employment information.
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
                value="{{ old('contact_number', $resident->contact_number ?? '') }}"
                placeholder="Example: 0917 123 4567"
            >

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
                value="{{ old('email', $resident->email ?? '') }}"
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
                value="{{ old('occupation', $resident->occupation ?? '') }}"
                placeholder="Example: Teacher, Student, Office Staff, Driver"
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
    HOUSEHOLD ASSIGNMENT
========================================================= --}}
<section class="resident-form-section">

    <div class="resident-form-section-header">

        <div class="form-section-icon">
            03
        </div>

        <div>
            <h3>Household Assignment</h3>

            <p>
                Assign the resident to a registered household in Barangay San Antonio.
            </p>
        </div>

    </div>


    <div class="resident-form-grid">


        {{-- Household --}}
        <div class="form-field form-field-full">

            <label for="household_id">
                Household
                <span class="required-mark">*</span>
            </label>

            <select
                name="household_id"
                id="household_id"
                class="form-select @error('household_id') is-invalid @enderror"
                required
            >

                <option value="">
                    Select household
                </option>


                @foreach($households as $household)

                    <option
                        value="{{ $household->id }}"
                        @selected(
                            (string) old(
                                'household_id',
                                $resident->household_id ?? ''
                            ) === (string) $household->id
                        )
                    >

                        {{ $household->household_number }}
                        —
                        {{ $household->household_head }}

                        @if($household->area)
                            —
                            {{ $household->area }}
                        @endif

                    </option>

                @endforeach

            </select>


            <div class="field-helper">
                The selected household determines the resident's Village / Street.
            </div>


            @error('household_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

    </div>


    {{-- =====================================================
        STATUS OPTIONS
    ====================================================== --}}
    <div class="resident-status-options">


        {{-- Registered Voter --}}
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
                    Resident is registered to vote.
                </small>

            </span>

        </label>


        {{-- Household Head --}}
        <label
            class="resident-status-card"
            for="is_household_head"
        >

            <input
                type="hidden"
                name="is_household_head"
                value="0"
            >

            <input
                type="checkbox"
                name="is_household_head"
                id="is_household_head"
                value="1"
                class="resident-status-checkbox"
                @checked(
                    old(
                        'is_household_head',
                        $resident->is_household_head ?? false
                    )
                )
            >


            <span class="status-check-box">
                ✓
            </span>


            <span class="status-option-content">

                <strong>
                    Household Head
                </strong>

                <small>
                    Mark this resident as the household head.
                </small>

            </span>

        </label>

    </div>

</section>