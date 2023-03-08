<?php

namespace Tests\Feature;

use App\Models\TruckDriver;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TruckDriverAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('truck_driver/login');

        $response->assertStatus(200);
    }

    public function test_truck_drivers_can_authenticate_using_the_login_screen()
    {
        $truck_driver = TruckDriver::factory()->create();

        $response = $this->post('truck_driver/login', [
            'email' => $truck_driver->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated('truck_driver');
        $response->assertRedirect(route('truck_driver.dashboard'));
    }

    public function test_truck_drivers_can_not_authenticate_with_invalid_password()
    {
        $truck_driver = TruckDriver::factory()->create();

        $this->post('truck_driver/login', [
            'email' => $truck_driver->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest('truck_driver');
    }
}
