<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user pertama
        $user = User::first();
        
        if (!$user) {
            $this->command->error('No user found. Please run AccountSeeder first.');
            return;
        }
        
        // Ambil akun dan kategori
        $accounts = Account::where('user_id', $user->id)->get();
        $incomeCategories = Category::where('user_id', $user->id)->where('type', 'income')->get();
        $expenseCategories = Category::where('user_id', $user->id)->where('type', 'expense')->get();
        
        if ($accounts->isEmpty() || $incomeCategories->isEmpty() || $expenseCategories->isEmpty()) {
            $this->command->error('Please run AccountSeeder and CategorySeeder first.');
            return;
        }
        
        // Data sample transaksi untuk 3 bulan terakhir
        $transactions = [];
        
        // Transaksi Income (Gaji bulanan)
        for ($i = 2; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i)->startOfMonth()->addDays(rand(0, 5));
            $bankAccount = $accounts->where('type', 'checking')->first();
            $salaryCategory = $incomeCategories->where('name', 'Gaji')->first();
            
            if ($bankAccount && $salaryCategory) {
                $transactions[] = [
                    'user_id' => $user->id,
                    'account_id' => $bankAccount->id,
                    'category_id' => $salaryCategory->id,
                    'type' => 'income',
                    'amount' => 8000000 + rand(-500000, 1000000), // Gaji 7.5-9jt
                    'description' => 'Gaji bulan ' . $date->format('F Y'),
                    'transaction_date' => $date,
                    'reference_number' => 'SAL-' . $date->format('Ym') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
                    'created_at' => $date,
                    'updated_at' => $date,
                ];
            }
        }
        
        // Transaksi Freelance (random)
        for ($i = 0; $i < 5; $i++) {
            $date = Carbon::now()->subDays(rand(1, 90));
            $bankAccount = $accounts->where('type', 'checking')->random();
            $freelanceCategory = $incomeCategories->where('name', 'Freelance')->first();
            
            if ($freelanceCategory) {
                $transactions[] = [
                    'user_id' => $user->id,
                    'account_id' => $bankAccount->id,
                    'category_id' => $freelanceCategory->id,
                    'type' => 'income',
                    'amount' => rand(500000, 3000000),
                    'description' => 'Proyek freelance ' . ['Website', 'Mobile App', 'Design', 'Konsultasi', 'Training'][rand(0, 4)],
                    'transaction_date' => $date,
                    'reference_number' => 'FRL-' . $date->format('Ymd') . '-' . str_pad(rand(1, 99), 2, '0', STR_PAD_LEFT),
                    'created_at' => $date,
                    'updated_at' => $date,
                ];
            }
        }
        
        // Transaksi Expense (berbagai kategori)
        $expenseData = [
            'Makanan' => [
                'count' => 25,
                'amount_range' => [15000, 150000],
                'descriptions' => ['Makan siang', 'Makan malam', 'Snack', 'Kopi', 'Groceries']
            ],
            'Transportasi' => [
                'count' => 15,
                'amount_range' => [10000, 100000],
                'descriptions' => ['Bensin', 'Ojek online', 'Parkir', 'Tol', 'Grab']
            ],
            'Belanja' => [
                'count' => 10,
                'amount_range' => [50000, 500000],
                'descriptions' => ['Belanja bulanan', 'Kebutuhan rumah', 'Pakaian', 'Elektronik']
            ],
            'Hiburan' => [
                'count' => 8,
                'amount_range' => [25000, 300000],
                'descriptions' => ['Bioskop', 'Karaoke', 'Nongkrong', 'Game', 'Streaming']
            ],
            'Tagihan' => [
                'count' => 6,
                'amount_range' => [100000, 800000],
                'descriptions' => ['Listrik', 'Air', 'Internet', 'Telepon', 'TV Kabel']
            ]
        ];
        
        foreach ($expenseData as $categoryName => $data) {
            $category = $expenseCategories->where('name', $categoryName)->first();
            if (!$category) continue;
            
            for ($i = 0; $i < $data['count']; $i++) {
                $date = Carbon::now()->subDays(rand(1, 90));
                $account = $accounts->where('is_active', true)->random();
                
                $transactions[] = [
                    'user_id' => $user->id,
                    'account_id' => $account->id,
                    'category_id' => $category->id,
                    'type' => 'expense',
                    'amount' => rand($data['amount_range'][0], $data['amount_range'][1]),
                    'description' => $data['descriptions'][rand(0, count($data['descriptions']) - 1)],
                    'transaction_date' => $date,
                    'reference_number' => 'EXP-' . $date->format('Ymd') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
                    'created_at' => $date,
                    'updated_at' => $date,
                ];
            }
        }
        
        // Transaksi Transfer (antar akun)
        for ($i = 0; $i < 5; $i++) {
            $date = Carbon::now()->subDays(rand(1, 60));
            $fromAccount = $accounts->where('is_active', true)->random();
            $toAccount = $accounts->where('is_active', true)->where('id', '!=', $fromAccount->id)->random();
            
            $transactions[] = [
                'user_id' => $user->id,
                'account_id' => $fromAccount->id,
                'to_account_id' => $toAccount->id,
                'category_id' => null,
                'type' => 'transfer',
                'amount' => rand(100000, 2000000),
                'description' => 'Transfer dari ' . $fromAccount->name . ' ke ' . $toAccount->name,
                'transaction_date' => $date,
                'reference_number' => 'TRF-' . $date->format('Ymd') . '-' . str_pad(rand(1, 99), 2, '0', STR_PAD_LEFT),
                'created_at' => $date,
                'updated_at' => $date,
            ];
        }
        
        // Urutkan transaksi berdasarkan tanggal
        usort($transactions, function($a, $b) {
            return $a['transaction_date']->timestamp - $b['transaction_date']->timestamp;
        });
        
        // Insert transaksi
        foreach ($transactions as $transaction) {
            Transaction::create($transaction);
        }
        
        $this->command->info('Sample transactions created successfully! Total: ' . count($transactions));
    }
}
