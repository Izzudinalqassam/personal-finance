<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user pertama atau buat user default
        $user = User::first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'Demo User',
                'email' => 'demo@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }
        
        // Data sample akun
        $accounts = [
            [
                'user_id' => $user->id,
                'name' => 'Kas Utama',
                'type' => 'cash',
                'balance' => 5000000,
                'currency' => 'IDR',
                'description' => 'Kas utama untuk operasional harian',
                'is_active' => true,
            ],
            [
                'user_id' => $user->id,
                'name' => 'Bank BCA',
                'type' => 'checking',
                'balance' => 15000000,
                'currency' => 'IDR',
                'description' => 'Rekening tabungan Bank BCA',
                'is_active' => true,
            ],
            [
                'user_id' => $user->id,
                'name' => 'Bank Mandiri',
                'type' => 'checking',
                'balance' => 8500000,
                'currency' => 'IDR',
                'description' => 'Rekening giro Bank Mandiri',
                'is_active' => true,
            ],
            [
                'user_id' => $user->id,
                'name' => 'E-Wallet OVO',
                'type' => 'cash',
                'balance' => 750000,
                'currency' => 'IDR',
                'description' => 'Saldo OVO untuk pembayaran digital',
                'is_active' => true,
            ],
            [
                'user_id' => $user->id,
                'name' => 'GoPay',
                'type' => 'cash',
                'balance' => 500000,
                'currency' => 'IDR',
                'description' => 'Saldo GoPay untuk transportasi dan makanan',
                'is_active' => true,
            ],
            [
                'user_id' => $user->id,
                'name' => 'Investasi Saham',
                'type' => 'investment',
                'balance' => 25000000,
                'currency' => 'IDR',
                'description' => 'Portfolio investasi saham',
                'is_active' => true,
            ],
            [
                'user_id' => $user->id,
                'name' => 'Tabungan Lama',
                'type' => 'savings',
                'balance' => 2000000,
                'currency' => 'IDR',
                'description' => 'Tabungan lama yang sudah tidak aktif',
                'is_active' => false,
            ],
        ];
        
        foreach ($accounts as $account) {
            Account::create($account);
        }
        
        $this->command->info('Sample accounts created successfully!');
    }
}
