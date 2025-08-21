<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default user first (if not exists)
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
            ]
        );
        
        // Run seeders in correct order
        $this->call([
            AccountSeeder::class,
            CategorySeeder::class,
            TransactionSeeder::class,
            BudgetSeeder::class,
        ]);
    }
}
