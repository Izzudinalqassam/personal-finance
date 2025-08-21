<?php

namespace App\Filament\Widgets;

use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainDashboardWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $userId = Auth::id();
        
        // Total Balance dari semua akun aktif
        $totalBalance = Account::where('user_id', $userId)
            ->where('is_active', true)
            ->sum('balance');
        
        // Total Akun Aktif
        $activeAccounts = Account::where('user_id', $userId)
            ->where('is_active', true)
            ->count();
        
        // Total Kategori Aktif
        $activeCategories = Category::where('user_id', $userId)
            ->where('is_active', true)
            ->count();
        
        // Total Transaksi Bulan Ini
        $monthlyTransactions = Transaction::where('user_id', $userId)
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->count();
        
        // Income vs Expense Bulan Ini
        $monthlyIncome = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount');
            
        $monthlyExpense = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount');
        
        $netIncome = $monthlyIncome - $monthlyExpense;
        
        // Chart data untuk 7 hari terakhir
        $weeklyData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dailyAmount = Transaction::where('user_id', $userId)
                ->whereDate('transaction_date', $date)
                ->where('type', 'income')
                ->sum('amount');
            $weeklyData[] = $dailyAmount / 1000; // Dalam ribuan untuk chart
        }
        
        return [
            Stat::make('Total Saldo', 'IDR ' . number_format($totalBalance, 0, ',', '.'))
                ->description('Saldo dari ' . $activeAccounts . ' akun aktif')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color($totalBalance >= 0 ? 'success' : 'danger')
                ->chart($weeklyData),
            
            Stat::make('Pendapatan Bersih', 'IDR ' . number_format($netIncome, 0, ',', '.'))
                ->description('Bulan ' . now()->format('F Y'))
                ->descriptionIcon($netIncome >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($netIncome >= 0 ? 'success' : 'danger')
                ->chart(array_reverse($weeklyData)),
            
            Stat::make('Transaksi Bulan Ini', number_format($monthlyTransactions))
                ->description('Total transaksi di ' . now()->format('F Y'))
                ->descriptionIcon('heroicon-m-rectangle-stack')
                ->color('info')
                ->chart([3, 7, 5, 12, 8, 15, $monthlyTransactions > 0 ? min($monthlyTransactions, 20) : 1]),
            
            Stat::make('Kategori Aktif', number_format($activeCategories))
                ->description('Kategori yang tersedia')
                ->descriptionIcon('heroicon-m-tag')
                ->color('warning')
                ->chart([1, 3, 2, 5, 4, 6, max($activeCategories, 1)]),
        ];
    }
}
