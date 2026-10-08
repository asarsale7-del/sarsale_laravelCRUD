<div class="mb-3">
    <label for="patient_id" class="form-label">Patient</label>
    <select id="patient_id" name="patient_id" class="form-select" required>
        <option value="">Select Patient</option>
        @foreach ($patients as $patient)
            <option value="{{ $patient->id }}" @selected((string) old('patient_id', $appointment->patient_id ?? request('patient_id')) === (string) $patient->id)>
                {{ $patient->first_name }} {{ $patient->last_name }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="appointment_date" class="form-label">Appointment Date</label>
    <input type="date" id="appointment_date" name="appointment_date" class="form-control" value="{{ old('appointment_date', isset($appointment) ? $appointment->appointment_date->format('Y-m-d') : '') }}" required>
</div>
<div class="mb-3">
    <label for="appointment_time" class="form-label">Appointment Time</label>
    <input type="time" id="appointment_time" name="appointment_time" class="form-control" value="{{ old('appointment_time', isset($appointment) ? substr((string) $appointment->appointment_time, 0, 5) : '') }}" required>
</div>
<div class="mb-3">
    <label for="reason" class="form-label">Reason</label>
    <textarea id="reason" name="reason" class="form-control" maxlength="2000" rows="3">{{ old('reason', $appointment->reason ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select id="status" name="status" class="form-select" required>
        @foreach (['scheduled' => 'Scheduled', 'completed' => 'Completed', 'cancelled' => 'Cancelled'] as $value => $label)
            <option value="{{ $value }}" @selected(old('status', $appointment->status ?? 'scheduled') === $value)>{{ $label }}</option>
        @endforeach
    </select>
</div>
