<?php

namespace Tests\Feature;

use App\Models\Guide;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingTest extends TestCase
{
    /**
     * A basic feature test example.
     */
//    public function test_example(): void
//    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }

    use RefreshDatabase;

    public function test_booking():void{
        $guide = Guide::factory()->create(['is_active' => true]);

        $response = $this->postJson(route('hunting_bookings.store'), [
            'tour_name' => 'summer hunt',
            'hunter_name' => 'Azamat',
            'guide_id' => $guide->id,
            'from_date' => '2025-01-01',
            'to_date' => '2025-01-02',
            'participant_count' => 3,
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['message', 'data' => ['id']]);

        $this->assertDatabaseHas('hunting_bookings', [
            'tour_name' => 'summer hunt',
            'guide_id' => $guide->id,
        ]);
    }
}
