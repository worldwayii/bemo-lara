<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Card;
use App\Models\Column;

class ColumnTest extends TestCase
{
    /**
     * @test
     * @group column
     */
    public function user_can_create_column()
    {
        $response = $this->postJson('/api/v1/columns' . '?access_token=test', [
            'title' => 'Test column',
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'data' => [
                'title' => 'Test column',
            ],
        ]);
        $this->assertDatabaseHas('columns', [
            'title' => 'Test column',
        ]);
    }
    /**
     * @test
     * @group column
     */
    public function user_can_delete_column()
    {
        $column = Column::factory()->create();
        $card = Card::factory()->create([
            'column_id' => $column->id,
        ]);
        $this->assertDatabaseHas('columns', [
            'id' => $column->id,
        ]);
        $this->assertDatabaseHas('cards', [
            'id' => $card->id,
        ]);

        $response = $this->deleteJson('/api/v1/columns/' . $column->id . '?access_token=test');
        $response->assertStatus(204);
        $this->assertDatabaseMissing('columns', [
            'id' => $column->id,
        ]);
        $this->assertDatabaseMissing('cards', [
            'id' => $card->id,
        ]);
    }
}
