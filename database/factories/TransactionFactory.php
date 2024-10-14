<?php

namespace Database\Factories;
use App\Models\Transaction;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;
       
     public function definition()
     {
         return [
            'user_id' => User::factory(), // This will create a new user; remove if you want to use existing users
            'amount' => $this->faker->randomFloat(2, 1, 1000),
            'description' => "Bill payment for ".$this->faker->randomElement([
                'Water Utility',
                'Electricity',
                'Internet Subscription',
                'Airtime',
                'Taxes',
            ]),
         ];
     }
}
