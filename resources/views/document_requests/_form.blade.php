@csrf


<section class="resident-form-section">

    <div class="resident-form-section-header">

        <div class="form-section-icon">
            01
        </div>

        <div>

            <h3>
                Request Information
            </h3>

            <p>
                Select the resident and document being requested.
            </p>

        </div>

    </div>


    <div class="resident-form-grid">


        {{-- Request Number --}}
        <div class="form-field">

            <label>
                Request Number
            </label>


            <div class="generated-id-field">

                <span class="generated-id-icon">
                    #
                </span>


                <span class="generated-id-value">

                    @if(isset($documentRequest))

                        {{ $documentRequest->request_number }}

                    @else

                        {{ $nextRequestNumber }}

                    @endif

                </span>


                <span class="generated-id-badge">
                    Auto-generated
                </span>

            </div>

        </div>


        {{-- Date --}}
        <div class="form-field">

            <label for="date_requested">

                Date Requested

                <span class="required-mark">
                    *
                </span>

            </label>


            <input
                type="date"
                name="date_requested"
                id="date_requested"
                class="form-control @error('date_requested') is-invalid @enderror"
                value="{{ old(
                    'date_requested',
                    isset($documentRequest)
                        ? $documentRequest->date_requested->format('Y-m-d')
                        : now('Asia/Manila')->format('Y-m-d')
                ) }}"
                required
            >

            @error('date_requested')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>


        {{-- Resident --}}
        <div class="form-field form-field-full">

            <label for="resident_id">

                Resident

                <span class="required-mark">
                    *
                </span>

            </label>


            <select
                name="resident_id"
                id="resident_id"
                class="form-select @error('resident_id') is-invalid @enderror"
                required
            >

                <option value="">
                    Select registered resident
                </option>


                @foreach($residents as $resident)

                    <option
                        value="{{ $resident->id }}"
                        @selected(
                            (string) old(
                                'resident_id',
                                $documentRequest->resident_id ?? ''
                            ) === (string) $resident->id
                        )
                    >
                        {{ $resident->resident_number }}
                        —
                        {{ $resident->full_name }}
                        —
                        {{ $resident->area }}
                    </option>

                @endforeach

            </select>


            @error('resident_id')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>


        {{-- Document Type --}}
        <div class="form-field">

            <label for="document_type">

                Document Type

                <span class="required-mark">
                    *
                </span>

            </label>


            <select
                name="document_type"
                id="document_type"
                class="form-select @error('document_type') is-invalid @enderror"
                required
            >

                <option value="">
                    Select document type
                </option>


                @foreach([
                    'Barangay Clearance',
                    'Certificate of Residency',
                    'Certificate of Indigency',
                    'Barangay Certification'
                ] as $type)

                    <option
                        value="{{ $type }}"
                        @selected(
                            old(
                                'document_type',
                                $documentRequest->document_type ?? ''
                            ) === $type
                        )
                    >
                        {{ $type }}
                    </option>

                @endforeach

            </select>


            @error('document_type')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>


        {{-- Status --}}
        <div class="form-field">

            <label for="status">

                Status

                <span class="required-mark">
                    *
                </span>

            </label>


            <select
                name="status"
                id="status"
                class="form-select @error('status') is-invalid @enderror"
                required
            >

                @foreach([
                    'Pending',
                    'Processing',
                    'Ready for Release',
                    'Released',
                    'Cancelled'
                ] as $statusOption)

                    <option
                        value="{{ $statusOption }}"
                        @selected(
                            old(
                                'status',
                                $documentRequest->status ?? 'Pending'
                            ) === $statusOption
                        )
                    >
                        {{ $statusOption }}
                    </option>

                @endforeach

            </select>


            @error('status')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>

    </div>

</section>


<section class="resident-form-section">

    <div class="resident-form-section-header">

        <div class="form-section-icon">
            02
        </div>

        <div>

            <h3>
                Request Purpose
            </h3>

            <p>
                State why the resident is requesting this document.
            </p>

        </div>

    </div>


    <div class="form-field">

        <label for="purpose">

            Purpose

            <span class="required-mark">
                *
            </span>

        </label>


        <textarea
            name="purpose"
            id="purpose"
            rows="4"
            class="form-control document-purpose-input @error('purpose') is-invalid @enderror"
            placeholder="Example: Employment requirement, scholarship application, proof of residency..."
            required
        >{{ old(
            'purpose',
            $documentRequest->purpose ?? ''
        ) }}</textarea>


        @error('purpose')

            <div class="invalid-feedback">
                {{ $message }}
            </div>

        @enderror

    </div>

</section>