<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppointmentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_appointment_can_be_created_and_shows_its_patient(): void
    {
        $patient = Patient::factory()->create([
            'first_name' => 'Grace',
            'last_name' => 'Hopper',
        ]);

        $response = $this->post(route('appointments.store'), [
            'patient_id' => $patient->id,
            'appointment_date' => '2026-11-12',
            'appointment_time' => '14:30',
            'reason' => 'Annual check-up',
            'status' => 'scheduled',
        ]);

        $appointment = Appointment::query()->firstOrFail();

        $response->assertRedirect(route('appointments.show', $appointment))
            ->assertSessionHas('status', 'Appointment created successfully.');
        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'patient_id' => $patient->id,
            'appointment_date' => '2026-11-12',
            'status' => 'scheduled',
        ]);
        $this->get(route('appointments.index'))
            ->assertOk()
            ->assertSee('Grace Hopper')
            ->assertSee('Annual check-up');
        $this->get(route('appointments.show', $appointment))
            ->assertOk()
            ->assertSee('Grace Hopper')
            ->assertSee('Annual check-up');
    }

    public function test_appointment_form_rejects_unknown_patients_and_invalid_dates(): void
    {
        $response = $this->from(route('appointments.create'))
            ->post(route('appointments.store'), [
                'patient_id' => 999,
                'appointment_date' => 'next Tuesday',
                'appointment_time' => 'afternoon',
                'status' => 'scheduled',
            ]);

        $response->assertRedirect(route('appointments.create'))
            ->assertSessionHasErrors([
                'patient_id' => 'The selected patient id is invalid.',
                'appointment_date' => 'The appointment date field must match the format Y-m-d.',
                'appointment_time' => 'The appointment time field must match the format H:i.',
            ]);
        $this->assertDatabaseCount('appointments', 0);
    }

    public function test_appointment_form_rejects_an_unsupported_status(): void
    {
        $patient = Patient::factory()->create();

        $response = $this->from(route('appointments.create'))
            ->post(route('appointments.store'), [
                'patient_id' => $patient->id,
                'appointment_date' => '2026-11-12',
                'appointment_time' => '14:30',
                'status' => 'pending',
            ]);

        $response->assertRedirect(route('appointments.create'))
            ->assertSessionHasErrors([
                'status' => 'The selected status is invalid.',
            ]);
        $this->assertDatabaseCount('appointments', 0);
    }

    public function test_appointment_can_be_updated_and_deleted(): void
    {
        $patient = Patient::factory()->create();
        $appointment = Appointment::factory()->for($patient)->create();

        $response = $this->put(route('appointments.update', $appointment), [
            'patient_id' => $patient->id,
            'appointment_date' => '2026-12-01',
            'appointment_time' => '09:15',
            'reason' => 'Follow-up',
            'status' => 'completed',
        ]);

        $response->assertRedirect(route('appointments.show', $appointment))
            ->assertSessionHas('status', 'Appointment updated successfully.');
        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'appointment_date' => '2026-12-01',
            'status' => 'completed',
            'reason' => 'Follow-up',
        ]);

        $this->delete(route('appointments.destroy', $appointment))
            ->assertRedirect(route('appointments.index'));
        $this->assertDatabaseMissing('appointments', ['id' => $appointment->id]);
    }

    public function test_appointment_form_prompts_for_a_patient_when_the_directory_is_empty(): void
    {
        $this->get(route('appointments.create'))
            ->assertOk()
            ->assertSee('Add a patient before scheduling an appointment.');
    }

    public function test_appointment_create_edit_and_show_pages_render(): void
    {
        $patient = Patient::factory()->create([
            'first_name' => 'Katherine',
            'last_name' => 'Johnson',
        ]);
        $appointment = Appointment::factory()->for($patient)->create();

        $this->get(route('appointments.create'))
            ->assertOk()
            ->assertSee('New appointment');
        $this->get(route('appointments.edit', $appointment))
            ->assertOk()
            ->assertSee('Edit appointment')
            ->assertSee('Katherine Johnson');
        $this->get(route('appointments.show', $appointment))
            ->assertOk()
            ->assertSee('Visit information')
            ->assertSee('Katherine Johnson');
    }
}
