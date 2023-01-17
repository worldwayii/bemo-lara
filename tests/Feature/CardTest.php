<?php

namespace Tests\Feature;

use App\Models\Card;
use App\Models\Column;
use Tests\TestCase;

class CardTest extends TestCase
{
    /**
     * @test
     */
    public function user_can_create_card()
    {
        $column = Column::factory()->create();

        $response = $this->postJson('/api/v1/columns/' . $column->id . '/cards' . '?access_token=test', [
            'title' => 'Test card',
            'description' => 'Test description',
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'data' => [
                'title' => 'Test card',
                'description' => 'Test description',
            ],
        ]);
        $this->assertDatabaseHas('cards', [
            'title' => 'Test card',
            'description' => 'Test description',
        ]);
    }
    /**
     * @test
     */
    public function user_can_view_all_cards()
    {
        $column = Column::factory()->create();
        Card::factory()->count(5)->create([
            'column_id' => $column->id,
        ]);

        $response = $this->getJson('/api/v1/columns/' . $column->id . '/cards' . '?access_token=test');
        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
    }
}
