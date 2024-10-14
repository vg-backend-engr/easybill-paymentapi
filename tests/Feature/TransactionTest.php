<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_transaction()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/transactions', [
            'user_id' => $user->id,
            'amount' => 100.50,
            'description' => 'Bill payment for electricity',
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'amount' => 100.50,
            'description' => 'Bill payment for electricity',
        ]);
        
    }

    #[Test]
    public function it_can_read_a_transaction()
    {
        // Fetch an existing user or create one if needed
        $user = User::factory()->create(); // Use this if you want to create a user for testing
        // $user = User::first(); // Use this if you want to use an existing user

        // Create a transaction associated with the user
        $transaction = Transaction::factory()->create([
            'user_id' => $user->id, // Assign the user ID
        ]);

        $response = $this->getJson("/api/transactions/{$transaction->id}");

        $response->assertOk();
        // Ensure the amount is a decimal (formatted as a string)
        $amount = number_format($transaction->amount, 2, '.', '');
        // Dump the response content for debugging
        // dump($response->getContent());
        // dd($response->getContent());
        // Log::info($response->getContent());
        $response->assertJsonFragment([
            'amount' =>  $amount,
            'user_id' => $transaction->user_id,
            'description' => $transaction->description,
        ]);
    }

    #[Test]
    public function it_can_update_a_transaction()
    {
        $transaction = Transaction::factory()->create();

        $response = $this->putJson("/api/transactions/{$transaction->id}", [
            'amount' => 200.75,
            'description' => 'Updated description',
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('transactions', ['amount' => 200.75, 'description' => 'Updated description']);
    }

    #[Test]
    public function it_can_delete_a_transaction()
    {
        $transaction = Transaction::factory()->create();

        $response = $this->deleteJson("/api/transactions/{$transaction->id}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('transactions', ['id' => $transaction->id]);
    }
}
