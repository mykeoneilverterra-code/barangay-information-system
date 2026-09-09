@csrf

<div class="mb-3">
    <label for="resident_number" class="form-label">Resident Number</label>

    <input
        type="text"
        name="resident_number"
        id="resident_number"
        class="form-control @error('resident_number') is-invalid @enderror"
        value="{{ old('resident_number', $resident->resident_number ?? '') }}">

    @error('resident_number')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="first_name" class="form-label">First Name</label>

    <input
        type="text"
        name="first_name"
        id="first_name"
        class="form-control @error('first_name') is-invalid @enderror"
        value="{{ old('first_name', $resident->first_name ?? '') }}">

    @error('first_name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="middle_name" class="form-label">Middle Name</label>

    <input
        type="text"
        name="middle_name"
        id="middle_name"
        class="form-control @error('middle_name') is-invalid @enderror"
        value="{{ old('middle_name', $resident->middle_name ?? '') }}">

    @error('middle_name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="last_name" class="form-label">Last Name</label>

    <input
        type="text"
        name="last_name"
        id="last_name"
        class="form-control @error('last_name') is-invalid @enderror"
        value="{{ old('last_name', $resident->last_name ?? '') }}">

    @error('last_name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="suffix" class="form-label">Suffix</label>

    <input
        type="text"
        name="suffix"
        id="suffix"
        class="form-control @error('suffix') is-invalid @enderror"
        value="{{ old('suffix', $resident->suffix ?? '') }}">

    @error('suffix')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="sex" class="form-label">Sex</label>

    <select name="sex" id="sex" class="form-select @error('sex') is-invalid @enderror">
        <option value="">Select sex</option>
        <option value="Male" @selected(old('sex', $resident->sex ?? '') === 'Male')>Male</option>
        <option value="Female" @selected(old('sex', $resident->sex ?? '') === 'Female')>Female</option>
    </select>

    @error('sex')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="birth_date" class="form-label">Birth Date</label>

    <input
        type="date"
        name="birth_date"
        id="birth_date"
        class="form-control @error('birth_date') is-invalid @enderror"
        value="{{ old('birth_date', isset($resident) && $resident->birth_date ? $resident->birth_date->format('Y-m-d') : '') }}">

    @error('birth_date')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="civil_status" class="form-label">Civil Status</label>

    <select name="civil_status" id="civil_status" class="form-select @error('civil_status') is-invalid @enderror">
        <option value="">Select civil status</option>
        @foreach(['Single', 'Married', 'Widowed', 'Separated'] as $status)
            <option value="{{ $status }}" @selected(old('civil_status', $resident->civil_status ?? '') === $status)>{{ $status }}</option>
        @endforeach
    </select>

    @error('civil_status')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="contact_number" class="form-label">Contact Number</label>

    <input
        type="text"
        name="contact_number"
        id="contact_number"
        class="form-control @error('contact_number') is-invalid @enderror"
        value="{{ old('contact_number', $resident->contact_number ?? '') }}">

    @error('contact_number')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>

    <input
        type="email"
        name="email"
        id="email"
        class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email', $resident->email ?? '') }}">

    @error('email')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="occupation" class="form-label">Occupation</label>

    <input
        type="text"
        name="occupation"
        id="occupation"
        class="form-control @error('occupation') is-invalid @enderror"
        value="{{ old('occupation', $resident->occupation ?? '') }}">

    @error('occupation')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="household_id" class="form-label">Household</label>

    <select name="household_id" id="household_id" class="form-select @error('household_id') is-invalid @enderror">
        <option value="">Select household</option>
        @foreach($households as $household)
            <option value="{{ $household->id }}" @selected((string) old('household_id', $resident->household_id ?? '') === (string) $household->id)>
                {{ $household->household_number }} - {{ $household->household_head }}
            </option>
        @endforeach
    </select>

    @error('household_id')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-check mb-3">
    <input type="hidden" name="is_voter" value="0">
    <input
        type="checkbox"
        name="is_voter"
        id="is_voter"
        value="1"
        class="form-check-input"
        @checked(old('is_voter', $resident->is_voter ?? false))>
    <label for="is_voter" class="form-check-label">Registered voter</label>
</div>

<div class="form-check mb-3">
    <input type="hidden" name="is_household_head" value="0">
    <input
        type="checkbox"
        name="is_household_head"
        id="is_household_head"
        value="1"
        class="form-check-input"
        @checked(old('is_household_head', $resident->is_household_head ?? false))>
    <label for="is_household_head" class="form-check-label">Household head</label>
</div>
