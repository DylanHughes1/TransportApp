<?php

namespace Tests\Feature;

use App\Models\TruckDriver;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class TruckDriverEmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_verification_screen_can_be_rendered()
    {
        $truck_driver = TruckDriver::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($truck_driver, 'truck_driver')->get('truck_driver/verify-email');

        $response->assertStatus(200);
    }

    public function test_email_can_be_verified()
    {
        Event::fake();

        $truck_driver = TruckDriver::factory()->create([
            'email_verified_at' => null,
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'truck_driver.verification.verify',
            now()->addMinutes(60),
            ['id' => $truck_driver->id, 'hash' => sha1($truck_driver->email)]
        );

        $response = $this->actingAs($truck_driver, 'truck_driver')->get($verificationUrl);

        Event::assertDispatched(Verified::class);
        $this->assertTrue($truck_driver->fresh()->hasVerifiedEmail());
        $response->assertRedirect(route('truck_driver.dashboard').'?verified=1');
    }

    public function test_email_is_not_verified_with_invalid_hash()
    {
        $truck_driver = TruckDriver::factory()->create([
            'email_verified_at' => null,
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'truck_driver.verification.verify',
            now()->addMinutes(60),
            ['id' => $truck_driver->id, 'hash' => sha1('wrong-email')]
        );

        $this->actingAs($truck_driver, 'truck_driver')->get($verificationUrl);

        $this->assertFalse($truck_driver->fresh()->hasVerifiedEmail());
    }
}
