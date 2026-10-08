<div class="form-grid">
    <div class="field">
        <label for="first_name">First name <span aria-hidden="true">*</span></label>
        <input id="first_name" name="first_name" value="{{ old('first_name', $patient->first_name ?? '') }}" maxlength="100" autocomplete="given-name" required>
        @error('first_name')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div class="field">
        <label for="last_name">Last name <span aria-hidden="true">*</span></label>
        <input id="last_name" name="last_name" value="{{ old('last_name', $patient->last_name ?? '') }}" maxlength="100" autocomplete="family-name" required>
        @error('last_name')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div class="field">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email', $patient->email ?? '') }}" maxlength="255" autocomplete="email">
        @error('email')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div class="field">
        <label for="phone">Phone</label>
        <input id="phone" type="tel" name="phone" value="{{ old('phone', $patient->phone ?? '') }}" maxlength="30" autocomplete="tel">
        @error('phone')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div class="field field-full">
        <label for="address">Address</label>
        <textarea id="address" name="address" maxlength="5000" autocomplete="street-address">{{ old('address', $patient->address ?? '') }}</textarea>
        @error('address')<p class="field-error">{{ $message }}</p>@enderror
    </div>
</div>
