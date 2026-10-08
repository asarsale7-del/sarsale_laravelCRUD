<div class="form-grid">
    <div class="field field-full">
        <label for="patient_id">Patient <span aria-hidden="true">*</span></label>
        <select id="patient_id" name="patient_id" required>
            <option value="">Choose a patient</option>
            @foreach ($patients as $patient)
                <option value="{{ $patient->id }}" @selected((string) old('patient_id', $appointment->patient_id ?? request('patient_id')) === (string) $patient->id)>
                    {{ $patient->first_name }} {{ $patient->last_name }}
                </option>
            @endforeach
        </select>
        @error('patient_id')<p class="field-error">{{ $message }}</p>@enderror
        @if ($patients->isEmpty())
            <p class="muted">Add a patient before scheduling an appointment.</p>
        @endif
    </div>
    <div class="field">
        <label for="appointment_date">Date <span aria-hidden="true">*</span></label>
        <input id="appointment_date" type="date" name="appointment_date" value="{{ old('appointment_date', isset($appointment) ? $appointment->appointment_date->format('Y-m-d') : '') }}" required>
        @error('appointment_date')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div class="field">
        <label for="appointment_time">Time <span aria-hidden="true">*</span></label>
        <input id="appointment_time" type="time" name="appointment_time" value="{{ old('appointment_time', isset($appointment) ? substr((string) $appointment->appointment_time, 0, 5) : '') }}" required>
        @error('appointment_time')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div class="field">
        <label for="status">Status <span aria-hidden="true">*</span></label>
        <select id="status" name="status" required>
            @foreach (['scheduled' => 'Scheduled', 'completed' => 'Completed', 'cancelled' => 'Cancelled'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $appointment->status ?? 'scheduled') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('status')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div class="field field-full">
        <label for="reason">Reason or notes</label>
        <textarea id="reason" name="reason" maxlength="2000">{{ old('reason', $appointment->reason ?? '') }}</textarea>
        @error('reason')<p class="field-error">{{ $message }}</p>@enderror
    </div>
</div>
