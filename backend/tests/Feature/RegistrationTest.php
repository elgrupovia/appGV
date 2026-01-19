<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_register_for_an_event()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->postJson("/api/events/{$event->id}/register");

        $response->assertStatus(201)
            ->assertJsonStructure(['message', 'registration']);

        $this->assertDatabaseHas('registrations', [
            'user_id' => $user->id,
            'event_id' => $event->id,
        ]);
    }

    public function test_a_user_cannot_register_for_an_event_twice()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create();

        // First registration
        $this->actingAs($user, 'sanctum')->postJson("/api/events/{$event->id}/register");

        // Second registration attempt
        $response = $this->actingAs($user, 'sanctum')->postJson("/api/events/{$event->id}/register");

        $response->assertStatus(409); // Conflict
    }

    public function test_a_user_can_list_their_registrations()
    {
        $user = User::factory()->create();
        $event1 = Event::factory()->create();
        $event2 = Event::factory()->create();

        $this->actingAs($user, 'sanctum')->postJson("/api/events/{$event1->id}/register");
        $this->actingAs($user, 'sanctum')->postJson("/api/events/{$event2->id}/register");

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/my-registrations');

        $response->assertStatus(200)
            ->assertJsonCount(2);
    }

    public function test_a_user_can_cancel_a_registration()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create();

        $this->actingAs($user, 'sanctum')->postJson("/api/events/{$event->id}/register");

        $registration = Registration::where('user_id', $user->id)->where('event_id', $event->id)->first();

        $response = $this->actingAs($user, 'sanctum')->deleteJson("/api/my-registrations/{$registration->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('registrations', [
            'id' => $registration->id,
        ]);
    }

    public function test_a_user_cannot_cancel_another_users_registration()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $event = Event::factory()->create();

        $this->actingAs($user1, 'sanctum')->postJson("/api/events/{$event->id}/register");

        $registration = Registration::where('user_id', $user1->id)->where('event_id', $event->id)->first();

        // user2 trying to cancel user1's registration
        $response = $this->actingAs($user2, 'sanctum')->deleteJson("/api/my-registrations/{$registration->id}");

        $response->assertStatus(403); // Forbidden
    }
}
