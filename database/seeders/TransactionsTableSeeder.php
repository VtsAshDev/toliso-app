<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $wallet = $user->wallet;
            $category = $user->categories()->first();

            if(!$wallet || !$category) {
                continue;
            }
            DB::table('transactions')->insert([
                'wallet_id' => $wallet->id,
                'category_id' => $category->id,
                'is_recurring' => false,
                'description' => fake()->text,
                'amount' => fake()->numberBetween(1000, 10000),
                'installments' => 0,
                'due_date' => fake()->date(),
                'transaction_date' => fake()->date(),
            ]);
        }
    }
}
