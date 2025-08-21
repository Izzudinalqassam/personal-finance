<?php

namespace App\Filament\Widgets;

use App\Models\Budget;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class BudgetOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Total budgets
        $totalBudgets = Budget::where('is_active', true)->count();
        
        // Total budget amount
        $totalBudgetAmount = Budget::where('is_active', true)->sum('amount');
        
        // Calculate total spent amount correctly
        $activeBudgets = Budget::where('is_active', true)->get();
        $totalSpentAmount = $activeBudgets->sum(function ($budget) {
            return $budget->spent_amount;
        });
        
        // Over budget count - calculate dynamically
        $overBudgetCount = $activeBudgets->filter(function ($budget) {
            return $budget->is_over_budget;
        })->count();
        
        // Average usage percentage - calculate dynamically
        $avgUsagePercentage = $activeBudgets->avg(function ($budget) {
            return $budget->usage_percentage;
        }) ?? 0;
        
        // Remaining budget
        $remainingBudget = $totalBudgetAmount - $totalSpentAmount;
        
        return [
            Stat::make('Total Budgets Aktif', $totalBudgets)
                ->description('Budget yang sedang berjalan')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('primary'),
                
            Stat::make('Total Anggaran', 'Rp ' . number_format($totalBudgetAmount, 0, ',', '.'))
                ->description('Total semua budget')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
                
            Stat::make('Total Pengeluaran', 'Rp ' . number_format($totalSpentAmount, 0, ',', '.'))
                ->description('Total yang sudah digunakan')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color($totalSpentAmount > $totalBudgetAmount ? 'danger' : 'warning'),
                
            Stat::make('Sisa Anggaran', 'Rp ' . number_format($remainingBudget, 0, ',', '.'))
                ->description('Anggaran yang tersisa')
                ->descriptionIcon('heroicon-m-wallet')
                ->color($remainingBudget < 0 ? 'danger' : 'success'),
                
            Stat::make('Rata-rata Penggunaan', number_format($avgUsagePercentage, 1) . '%')
                ->description('Persentase penggunaan rata-rata')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color($avgUsagePercentage > 80 ? 'danger' : ($avgUsagePercentage > 60 ? 'warning' : 'success')),
                
            Stat::make('Budget Over Limit', $overBudgetCount)
                ->description('Budget yang melebihi batas')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($overBudgetCount > 0 ? 'danger' : 'success'),
        ];
    }
    
    protected function getColumns(): int
    {
        return 3; // Display 3 stats per row
    }
}