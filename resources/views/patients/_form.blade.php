<div class="mb-3">
    <label for="first_name" class="form-label">First Name</label>
    <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name', $patient->first_name ?? '') }}" maxlength="100" required>
</div>
<div class="mb-3">
    <label for="last_name" class="form-label">Last Name</label>
    <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name', $patient->last_name ?? '') }}" maxlength="100" required>
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $patient->email ?? '') }}" maxlength="255">
</div>
<div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $patient->phone ?? '') }}" maxlength="30">
</div>
<div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <textarea id="address" name="address" class="form-control" maxlength="5000" rows="3">{{ old('address', $patient->address ?? '') }}</textarea>
</div>
