@csrf

<div class="row g-4">

    {{-- Household Number --}}
    <div class="col-md-6">

        <label
            for="household_number"
            class="form-label"
        >
            Household Number
        </label>

        <input
            type="text"
            id="household_number"
            name="household_number"
            class="form-control @error('household_number') is-invalid @enderror"
            value="{{ old('household_number', $household->household_number ?? '') }}"
            placeholder="Example: HH-00011"
            required
        >

        @error('household_number')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Household Head --}}
    <div class="col-md-6">

        <label
            for="household_head"
            class="form-label"
        >
            Household Head
        </label>

        <input
            type="text"
            id="household_head"
            name="household_head"
            class="form-control @error('household_head') is-invalid @enderror"
            value="{{ old('household_head', $household->household_head ?? '') }}"
            placeholder="Example: Juan Miguel Santos"
            required
        >

        @error('household_head')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Village / Street --}}
    <div class="col-md-6">

        <label
            for="area"
            class="form-label"
        >
            Village / Street
        </label>

        <select
            id="area"
            name="area"
            class="form-select @error('area') is-invalid @enderror"
            required
        >

            <option value="">
                Select village or street
            </option>

            @php
                $areas = [
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
            @endphp

            @foreach($areas as $area)

                <option
                    value="{{ $area }}"
                    {{ old(
                        'area',
                        $household->area ?? ''
                    ) === $area ? 'selected' : '' }}
                >
                    {{ $area }}
                </option>

            @endforeach

        </select>

        @error('area')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Contact Number --}}
    <div class="col-md-6">

        <label
            for="contact_number"
            class="form-label"
        >
            Contact Number
        </label>

        <input
            type="text"
            id="contact_number"
            name="contact_number"
            class="form-control @error('contact_number') is-invalid @enderror"
            value="{{ old('contact_number', $household->contact_number ?? '') }}"
            placeholder="Example: 09170000011"
        >

        @error('contact_number')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Address --}}
    <div class="col-12">

        <label
            for="address"
            class="form-label"
        >
            Complete Address
        </label>

        <textarea
            id="address"
            name="address"
            rows="3"
            class="form-control @error('address') is-invalid @enderror"
            placeholder="Example: Blk 4 Lot 12, St. Rose Village 3, Brgy. San Antonio, Biñan, Laguna"
            required
        >{{ old('address', $household->address ?? '') }}</textarea>

        <div class="form-text">
            All household records should be located in Brgy. San Antonio, Biñan, Laguna.
        </div>

        @error('address')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

</div>