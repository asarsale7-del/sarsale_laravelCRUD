<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PatientControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_patient_can_be_created_and_appears_in_the_directory(): void
    {
        $response = $this->post(route('patients.store'), [
            'first_name' => 'Ada',
            'last_name' => 'Lovelace',
            'email' => 'ada@example.com',
            'phone' => '555-0100',
            'address' => '12 Analytical Engine Way',
        ]);

        $patient = Patient::query()->where('email', 'ada@example.com')->firstOrFail();

        $response->assertRedirect(route('patients.index'))
            ->assertSessionHas('success', 'Patient created successfully.');
        $this->assertDatabaseHas('patients', [
            'id' => $patient->id,
            'first_name' => 'Ada',
            'last_name' => 'Lovelace',
        ]);
        $this->get(route('patients.index'))
            ->assertOk()
            ->assertSee('Ada Lovelace');
    }

    public function test_patient_form_shows_validation_errors_for_missing_required_names(): void
    {
        $response = $this->from(route('patients.create'))
            ->post(route('patients.store'), []);

        $response->assertRedirect(route('patients.create'))
            ->assertSessionHasErrors([
                'first_name' => 'The first name field is required.',
                'last_name' => 'The last name field is required.',
            ]);
        $this->assertDatabaseCount('patients', 0);
    }

    public function test_patient_form_rejects_an_invalid_email_address(): void
    {
        $response = $this->from(route('patients.create'))
            ->post(route('patients.store'), [
                'first_name' => 'Ada',
                'last_name' => 'Lovelace',
                'email' => 'not-an-email',
            ]);

        $response->assertRedirect(route('patients.create'))
            ->assertSessionHasErrors([
                'email' => 'The email field must be a valid email address.',
            ]);
        $this->assertDatabaseCount('patients', 0);
    }

    public function test_patient_form_rejects_an_email_that_is_already_in_use(): void
    {
        $existingPatient = Patient::factory()->create([
            'email' => 'ada@example.com',
        ]);

        $response = $this->from(route('patients.create'))
            ->post(route('patients.store'), [
                'first_name' => 'Augusta',
                'last_name' => 'King',
                'email' => $existingPatient->email,
            ]);

        $response->assertRedirect(route('patients.create'))
            ->assertSessionHasErrors([
                'email' => 'The email has already been taken.',
            ]);
        $this->assertDatabaseCount('patients', 1);
    }

    public function test_patient_can_be_updated_and_deleted_with_associated_appointments(): void
    {
        $patient = Patient::factory()->create([
            'first_name' => 'Ada',
            'last_name' => 'Lovelace',
        ]);
        $appointment = Appointment::factory()->for($patient)->create();

        $response = $this->put(route('patients.update', $patient), [
            'first_name' => 'Augusta',
            'last_name' => 'King',
            'email' => $patient->email,
            'phone' => '555-0101',
            'address' => 'New address',
        ]);

        $response->assertRedirect(route('patients.index'))
            ->assertSessionHas('success', 'Patient updated successfully.');
        $this->assertDatabaseHas('patients', [
            'id' => $patient->id,
            'first_name' => 'Augusta',
            'last_name' => 'King',
        ]);

        $this->delete(route('patients.destroy', $patient))
            ->assertRedirect(route('patients.index'))
            ->assertSessionHas('success', 'Patient and associated appointments deleted successfully.');

        $this->assertDatabaseMissing('patients', ['id' => $patient->id]);
        $this->assertDatabaseMissing('appointments', ['id' => $appointment->id]);
    }

    public function test_patient_create_edit_and_show_pages_render(): void
    {
        $patient = Patient::factory()->create([
            'first_name' => 'Katherine',
            'last_name' => 'Johnson',
        ]);

        $this->get(route('patients.create'))
            ->assertOk()
            ->assertSee('Add patient');
        $this->get(route('patients.edit', $patient))
            ->assertOk()
            ->assertSee('Katherine')
            ->assertSee('Save changes');
        $this->get(route('patients.show', $patient))
            ->assertOk()
            ->assertSee('Katherine Johnson')
            ->assertSee('Contact information');
    }

    public function test_patient_names_are_escaped_in_the_directory(): void
    {
        Patient::factory()->create([
            'first_name' => '<script>alert(1)</script>',
            'last_name' => 'Example',
        ]);

        $this->get(route('patients.index'))
            ->assertOk()
            ->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false)
            ->assertDontSee('<script>alert(1)</script>', false);
    }
}
