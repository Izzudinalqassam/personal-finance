<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Budget;
use App\Models\User;
use App\Models\Category;
use Carbon\Carbon;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user pertama
        $user = User::first();
        
        if (!$user) {
            $this->command->error('No user found. Please run user seeder first.');
            return;
        }

        // Ambil beberapa kategori untuk expense
        $categories = Category::where('user_id', $user->id)
            ->where('type', 'expense')
            ->get();
            
        if ($categories->isEmpty()) {
            $this->command->error('No expense categories found. Please run CategorySeeder first.');
            return;
        }

        $budgets = [
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('name', 'Makanan & Minuman')->first()?->id ?? $categories->first()->id,
                'name' => 'Anggaran Bulanan Januari 2024',
                'amount' => 1500000.00,
                'period_type' => 'monthly',
                'start_date' => Carbon::create(2024, 1, 1),
                'end_date' => Carbon::create(2024, 1, 31),
                'description' => 'Anggaran untuk kebutuhan hidup sehari-hari dan pengeluaran rutin bulanan',
                'is_active' => true,
                'alert_threshold' => 80.00,
                'alert_enabled' => true
            ],
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('name', 'Teknologi')->first()?->id ?? $categories->first()->id,
                'name' => 'Anggaran Proyek Website E-Commerce',
                'amount' => 5000000.00,
                'period_type' => 'custom',
                'start_date' => Carbon::create(2024, 2, 1),
                'end_date' => Carbon::create(2024, 5, 31),
                'description' => 'Anggaran untuk pengembangan platform e-commerce termasuk hosting, domain, dan development',
                'is_active' => true,
                'alert_threshold' => 75.00,
                'alert_enabled' => true
            ],
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('name', 'Pendidikan')->first()?->id ?? $categories->first()->id,
                'name' => 'Anggaran Pendidikan Semester Genap',
                'amount' => 2500000.00,
                'period_type' => 'custom',
                'start_date' => Carbon::create(2024, 2, 1),
                'end_date' => Carbon::create(2024, 6, 30),
                'description' => 'Anggaran untuk biaya kuliah, buku, dan kebutuhan akademik semester genap',
                'is_active' => true,
                'alert_threshold' => 85.00,
                'alert_enabled' => true
            ],
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('name', 'Hiburan')->first()?->id ?? $categories->first()->id,
                'name' => 'Anggaran Liburan Keluarga',
                'amount' => 3000000.00,
                'period_type' => 'custom',
                'start_date' => Carbon::create(2024, 6, 1),
                'end_date' => Carbon::create(2024, 6, 15),
                'description' => 'Anggaran untuk liburan keluarga ke Bali termasuk tiket pesawat, hotel, dan aktivitas wisata',
                'is_active' => true,
                'alert_threshold' => 90.00,
                'alert_enabled' => true
            ],
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('name', 'Bisnis')->first()?->id ?? $categories->first()->id,
                'name' => 'Anggaran Marketing Digital Q2',
                'amount' => 7500000.00,
                'period_type' => 'quarterly',
                'start_date' => Carbon::create(2024, 4, 1),
                'end_date' => Carbon::create(2024, 6, 30),
                'description' => 'Anggaran untuk kampanye digital marketing, iklan online, dan promosi produk quarter kedua',
                'is_active' => true,
                'alert_threshold' => 70.00,
                'alert_enabled' => true
            ],
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('name', 'Rumah Tangga')->first()?->id ?? $categories->first()->id,
                'name' => 'Anggaran Renovasi Rumah',
                'amount' => 10000000.00,
                'period_type' => 'custom',
                'start_date' => Carbon::create(2024, 3, 1),
                'end_date' => Carbon::create(2024, 8, 31),
                'description' => 'Anggaran untuk renovasi kamar tidur, dapur, dan taman belakang rumah',
                'is_active' => true,
                'alert_threshold' => 85.00,
                'alert_enabled' => true
            ],
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('name', 'Pendidikan')->first()?->id ?? $categories->first()->id,
                'name' => 'Anggaran Kursus Sertifikasi IT',
                'amount' => 1200000.00,
                'period_type' => 'custom',
                'start_date' => Carbon::create(2024, 3, 15),
                'end_date' => Carbon::create(2024, 9, 15),
                'description' => 'Anggaran untuk mengikuti kursus sertifikasi AWS, Azure, dan Google Cloud Platform',
                'is_active' => true,
                'alert_threshold' => 80.00,
                'alert_enabled' => true
            ],
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('name', 'Bisnis')->first()?->id ?? $categories->first()->id,
                'name' => 'Anggaran Operasional Kantor Q1',
                'amount' => 4500000.00,
                'period_type' => 'quarterly',
                'start_date' => Carbon::create(2024, 1, 1),
                'end_date' => Carbon::create(2024, 3, 31),
                'description' => 'Anggaran untuk biaya operasional kantor termasuk listrik, internet, supplies, dan maintenance',
                'is_active' => true,
                'alert_threshold' => 75.00,
                'alert_enabled' => true
            ],
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('name', 'Lainnya')->first()?->id ?? $categories->first()->id,
                'name' => 'Anggaran Emergency Fund',
                'amount' => 6000000.00,
                'period_type' => 'yearly',
                'start_date' => Carbon::create(2024, 1, 1),
                'end_date' => Carbon::create(2024, 12, 31),
                'description' => 'Dana darurat untuk keperluan mendesak dan tidak terduga sepanjang tahun 2024',
                'is_active' => true,
                'alert_threshold' => 95.00,
                'alert_enabled' => true
            ],
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('name', 'Pendidikan')->first()?->id ?? $categories->first()->id,
                'name' => 'Anggaran Workshop & Training Karyawan',
                'amount' => 3500000.00,
                'period_type' => 'custom',
                'start_date' => Carbon::create(2024, 5, 1),
                'end_date' => Carbon::create(2024, 11, 30),
                'description' => 'Anggaran untuk pelatihan dan workshop pengembangan skill karyawan',
                'is_active' => true,
                'alert_threshold' => 80.00,
                'alert_enabled' => true
            ]
        ];

        foreach ($budgets as $budget) {
            Budget::create($budget);
        }
        
        $this->command->info('Budget seeder completed successfully!');
    }
}