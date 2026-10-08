<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_shows_patient_and_upcoming_appointment_totals(): void
    {
        $patient = Patient::factory()->create([
            'first_name' => 'Grace',
            'last_name' => 'Hopper',
        ]);
        Appointment::factory()->for($patient)->create([
            'appointment_date' => '2099-03-15',
            'appointment_time' => '10:30',
            'status' => 'scheduled',
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Grace Hopper')
            ->assertSee('Registered patients')
            ->assertSee('All appointments');
    }
}
