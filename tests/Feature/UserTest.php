<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class UserTest extends TestCase
{
    use RefreshDatabase;
    #[Test]
    public function it_can_create_a_user()
    {
        $response = $this->postJson('/api/users', [
            'name' => 'Femi Falana',
            'email' => 'ff@gmail.com',
            'password' => 'password123',
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('users', [
            'name' => 'Femi Falana',
            'email' => 'ff@gmail.com',
        ]);
    }

    #[Test]
    public function it_can_read_a_user()
    {
        $user = User::factory()->create();

        $response = $this->getJson("/api/users/{$user->id}");

        $response->assertOk();
        $response->assertJsonFragment(['name' => $user->name]);
    }

    #[Test]
    public function it_can_update_a_user()
    {
        $user = User::factory()->create();

        $response = $this->putJson("/api/users/{$user->id}", [
            'name' => 'Updated Name',
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('users', ['name' => 'Updated Name']);
    }

    #[Test]
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/api/users/{$user->id}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
