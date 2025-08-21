<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
        
        // Data sample kategori income
        $incomeCategories = [
            [
                'user_id' => $user->id,
                'name' => 'Gaji',
                'type' => 'income',
                'color' => 'success',
                'icon' => 'heroicon-o-banknotes',
                'description' => 'Pendapatan dari gaji bulanan',
                'is_active' => true,
            ],
            [
                'user_id' => $user->id,
                'name' => 'Freelance',
                'type' => 'income',
                'color' => 'info',
                'icon' => 'heroicon-o-computer-desktop',
                'description' => 'Pendapatan dari pekerjaan freelance',
                'is_active' => true,
            ],
            [
                'user_id' => $user->id,
                'name' => 'Investasi',
                'type' => 'income',
                'color' => 'warning',
                'icon' => 'heroicon-o-chart-bar',
                'description' => 'Keuntungan dari investasi',
                'is_active' => true,
            ],
            [
                'user_id' => $user->id,
                'name' => 'Bonus',
                'type' => 'income',
                'color' => 'success',
                'icon' => 'heroicon-o-gift',
                'description' => 'Bonus dan tunjangan',
                'is_active' => true,
            ],
        ];
        
        // Data sample kategori expense
        $expenseCategories = [
            [
                'user_id' => $user->id,
                'name' => 'Makanan',
                'type' => 'expense',
                'color' => 'danger',
                'icon' => 'heroicon-o-cake',
                'description' => 'Pengeluaran untuk makanan dan minuman',
                'is_active' => true,
            ],
            [
                'user_id' => $user->id,
                'name' => 'Transportasi',
                'type' => 'expense',
                'color' => 'warning',
                'icon' => 'heroicon-o-truck',
                'description' => 'Biaya transportasi dan bahan bakar',
                'is_active' => true,
            ],
            [
                'user_id' => $user->id,
                'name' => 'Belanja',
                'type' => 'expense',
                'color' => 'info',
                'icon' => 'heroicon-o-shopping-bag',
                'description' => 'Belanja kebutuhan sehari-hari',
                'is_active' => true,
            ],
            [
                'user_id' => $user->id,
                'name' => 'Hiburan',
                'type' => 'expense',
                'color' => 'purple',
                'icon' => 'heroicon-o-film',
                'description' => 'Pengeluaran untuk hiburan dan rekreasi',
                'is_active' => true,
            ],
            [
                'user_id' => $user->id,
                'name' => 'Kesehatan',
                'type' => 'expense',
                'color' => 'danger',
                'icon' => 'heroicon-o-heart',
                'description' => 'Biaya kesehatan dan obat-obatan',
                'is_active' => true,
            ],
            [
                'user_id' => $user->id,
                'name' => 'Pendidikan',
                'type' => 'expense',
                'color' => 'info',
                'icon' => 'heroicon-o-academic-cap',
                'description' => 'Biaya pendidikan dan kursus',
                'is_active' => true,
            ],
            [
                'user_id' => $user->id,
                'name' => 'Tagihan',
                'type' => 'expense',
                'color' => 'gray',
                'icon' => 'heroicon-o-document-text',
                'description' => 'Tagihan listrik, air, internet, dll',
                'is_active' => true,
            ],
            [
                'user_id' => $user->id,
                'name' => 'Lain-lain',
                'type' => 'expense',
                'color' => 'gray',
                'icon' => 'heroicon-o-ellipsis-horizontal',
                'description' => 'Pengeluaran lain-lain',
                'is_active' => true,
            ],
        ];
        
        // Gabungkan semua kategori
        $allCategories = array_merge($incomeCategories, $expenseCategories);
        
        foreach ($allCategories as $category) {
            Category::create($category);
        }
        
        $this->command->info('Sample categories created successfully!');
    }
}
