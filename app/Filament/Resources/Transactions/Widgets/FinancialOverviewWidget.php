<?php

namespace App\Filament\Resources\Transactions\Widgets;

use App\Models\Account;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class FinancialOverviewWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $userId = Auth::id();
        
        // Total Balance dari semua akun aktif
        $totalBalance = Account::where('user_id', $userId)
            ->where('is_active', true)
            ->sum('balance');
        
        // Total Income (transaksi masuk)
        $totalIncome = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->sum('amount');
        
        // Total Expense (transaksi keluar)
        $totalExpense = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->sum('amount');
        
        // Total Transfer
        $totalTransfer = Transaction::where('user_id', $userId)
            ->where('type', 'transfer')
            ->sum('amount');
        
        return [
            Stat::make('Total Saldo', 'IDR ' . number_format($totalBalance, 0, ',', '.'))
                ->description('Saldo dari semua akun aktif')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            
            Stat::make('Total Pemasukan', 'IDR ' . number_format($totalIncome, 0, ',', '.'))
                ->description('Total transaksi masuk')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([3, 7, 5, 12, 8, 15, 20]),
            
            Stat::make('Total Pengeluaran', 'IDR ' . number_format($totalExpense, 0, ',', '.'))
                ->description('Total transaksi keluar')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([20, 15, 8, 12, 5, 7, 3]),
            
            Stat::make('Total Transfer', 'IDR ' . number_format($totalTransfer, 0, ',', '.'))
                ->description('Total transaksi transfer')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('info')
                ->chart([5, 8, 3, 10, 6, 12, 9]),
        ];
    }
}
