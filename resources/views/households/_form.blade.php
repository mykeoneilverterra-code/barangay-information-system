@csrf

<div class="mb-3">
    <label for="household_number" class="form-label">
        Household Number
    </label>

    <input
        type="text"
        name="household_number"
        id="household_number"
        class="form-control @error('household_number') is-invalid @enderror"
        value="{{ old('household_number', $household->household_number ?? '') }}">

    @error('household_number')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>


<div class="mb-3">
    <label for="household_head" class="form-label">
        Household Head
    </label>

    <input
        type="text"
        name="household_head"
        id="household_head"
        class="form-control @error('household_head') is-invalid @enderror"
        value="{{ old('household_head', $household->household_head ?? '') }}">

    @error('household_head')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>


<div class="mb-3">
    <label for="address" class="form-label">
        Address
    </label>

    <input
        type="text"
        name="address"
        id="address"
        class="form-control @error('address') is-invalid @enderror"
        value="{{ old('address', $household->address ?? '') }}">

    @error('address')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>


<div class="mb-3">
    <label for="purok" class="form-label">
        Purok
    </label>

    <input
        type="text"
        name="purok"
        id="purok"
        class="form-control @error('purok') is-invalid @enderror"
        value="{{ old('purok', $household->purok ?? '') }}">

    @error('purok')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>


<div class="mb-3">
    <label for="contact_number" class="form-label">
        Contact Number
    </label>

    <input
        type="text"
        name="contact_number"
        id="contact_number"
        class="form-control @error('contact_number') is-invalid @enderror"
        value="{{ old('contact_number', $household->contact_number ?? '') }}">

    @error('contact_number')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>