<?php

namespace Tests\Feature;

use App\Models\TruckDriver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TruckDriverPasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function test_confirm_password_screen_can_be_rendered()
    {
        $truck_driver = TruckDriver::factory()->create();

        $response = $this->actingAs($truck_driver, 'truck_driver')->get('truck_driver/confirm-password');

        $response->assertStatus(200);
    }

    public function test_password_can_be_confirmed()
    {
        $truck_driver = TruckDriver::factory()->create();

        $response = $this->actingAs($truck_driver, 'truck_driver')->post('truck_driver/confirm-password', [
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function test_password_is_not_confirmed_with_invalid_password()
    {
        $truck_driver = TruckDriver::factory()->create();

        $response = $this->actingAs($truck_driver, 'truck_driver')->post('truck_driver/confirm-password', [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
    }
}
