<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TruckDriverRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('truck_driver/register');

        $response->assertStatus(200);
    }

    public function test_new_truck_drivers_can_register()
    {
        $response = $this->post('truck_driver/register', [
            'name' => 'Test TruckDriver',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated('truck_driver');
        $response->assertRedirect(route('truck_driver.dashboard'));
    }
}
