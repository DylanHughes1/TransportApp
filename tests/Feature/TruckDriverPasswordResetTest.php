<?php

namespace Tests\Feature;

use App\Models\TruckDriver;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class TruckDriverPasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_reset_password_link_screen_can_be_rendered()
    {
        $response = $this->get('truck_driver/forgot-password');

        $response->assertStatus(200);
    }

    public function test_reset_password_link_can_be_requested()
    {
        Notification::fake();

        $truck_driver = TruckDriver::factory()->create();

        $response = $this->post('truck_driver/forgot-password', [
            'email' => $truck_driver->email,
        ]);

        Notification::assertSentTo($truck_driver, ResetPassword::class);
    }

    public function test_reset_password_screen_can_be_rendered()
    {
        Notification::fake();

        $truck_driver = TruckDriver::factory()->create();

        $response = $this->post('truck_driver/forgot-password', [
            'email' => $truck_driver->email,
        ]);

        Notification::assertSentTo($truck_driver, ResetPassword::class, function ($notification) {
            $response = $this->get('truck_driver/reset-password/'.$notification->token);

            $response->assertStatus(200);

            return true;
        });
    }

    public function test_password_can_be_reset_with_valid_token()
    {
        Notification::fake();

        $truck_driver = TruckDriver::factory()->create();

        $response = $this->post('truck_driver/forgot-password', [
            'email' => $truck_driver->email,
        ]);

        Notification::assertSentTo($truck_driver, ResetPassword::class, function ($notification) use ($truck_driver) {
            $response = $this->post('truck_driver/reset-password', [
                'token' => $notification->token,
                'email' => $truck_driver->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            $response->assertSessionHasNoErrors();

            return true;
        });
    }
}
