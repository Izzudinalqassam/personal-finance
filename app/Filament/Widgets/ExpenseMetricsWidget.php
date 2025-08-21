<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class ExpenseMetricsWidget extends BaseWidget
{
    protected ?string $pollingInterval = '30s';
    protected static bool $isLazy = false;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $userId = Auth::id();
        $currentMonth = Carbon::now()->startOfMonth();
        $previousMonth = Carbon::now()->subMonth()->startOfMonth();
        $previousMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        // Current month expenses
        $currentMonthExpenses = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->where('transaction_date', '>=', $currentMonth)
            ->sum('amount');

        // Previous month expenses
        $previousMonthExpenses = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$previousMonth, $previousMonthEnd])
            ->sum('amount');

        // Calculate percentage change
        $percentageChange = 0;
        if ($previousMonthExpenses > 0) {
            $percentageChange = (($currentMonthExpenses - $previousMonthExpenses) / $previousMonthExpenses) * 100;
        }

        // Today's expenses
        $todayExpenses = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereDate('transaction_date', Carbon::today())
            ->sum('amount');

        // This week's expenses
        $weekExpenses = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('amount');

        // Average daily expenses this month
        $daysInMonth = Carbon::now()->daysInMonth;
        $daysPassed = Carbon::now()->day;
        $avgDailyExpenses = $daysPassed > 0 ? $currentMonthExpenses / $daysPassed : 0;

        // Transaction count this month
        $transactionCount = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->where('transaction_date', '>=', $currentMonth)
            ->count();

        return [
            Stat::make('Pengeluaran Bulan Ini', 'Rp ' . number_format($currentMonthExpenses, 0, ',', '.'))
                ->description($this->getChangeDescription($percentageChange) . ' • ' . $transactionCount . ' transaksi')
                ->descriptionIcon($percentageChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($percentageChange >= 0 ? 'danger' : 'success')
                ->chart($this->getMonthlyChart($userId)),

            Stat::make('Hari Ini & Minggu Ini', 'Rp ' . number_format($todayExpenses, 0, ',', '.'))
                ->description('Minggu: Rp ' . number_format($weekExpenses, 0, ',', '.') . ' • ' . 
                    Transaction::where('user_id', $userId)
                        ->where('type', 'expense')
                        ->whereDate('transaction_date', Carbon::today())
                        ->count() . ' transaksi hari ini')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('warning')
                ->chart($this->getWeeklyChart($userId)),

            Stat::make('Rata-rata & Proyeksi', 'Rp ' . number_format($avgDailyExpenses, 0, ',', '.'))
                ->description('Proyeksi bulan: Rp ' . number_format($avgDailyExpenses * $daysInMonth, 0, ',', '.') . ' • Berdasarkan ' . $daysPassed . ' hari')
                ->descriptionIcon('heroicon-m-calculator')
                ->color('info'),

            Stat::make('Efisiensi Pengeluaran', $this->getEfficiencyScore($currentMonthExpenses, $avgDailyExpenses, $daysInMonth))
                ->description($this->getEfficiencyDescription($currentMonthExpenses, $avgDailyExpenses, $daysInMonth, $percentageChange))
                ->descriptionIcon('heroicon-m-chart-bar-square')
                ->color($this->getEfficiencyColor($percentageChange)),
        ];
    }

    private function getChangeDescription(float $percentage): string
    {
        $absPercentage = abs($percentage);
        $direction = $percentage >= 0 ? 'naik' : 'turun';
        return number_format($absPercentage, 1) . '% ' . $direction . ' dari bulan lalu';
    }

    private function getMonthlyChart(int $userId): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $amount = Transaction::where('user_id', $userId)
                ->where('type', 'expense')
                ->whereDate('transaction_date', $date)
                ->sum('amount');
            $data[] = (float) $amount;
        }
        return $data;
    }

    private function getWeeklyChart(int $userId): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $amount = Transaction::where('user_id', $userId)
                ->where('type', 'expense')
                ->whereDate('transaction_date', $date)
                ->sum('amount');
            $data[] = (float) $amount;
        }
        return $data;
    }

    private function getEfficiencyScore(float $currentExpenses, float $avgDaily, int $daysInMonth): string
    {
        if ($avgDaily == 0) return 'N/A';
        
        $projectedMonthly = $avgDaily * $daysInMonth;
        $efficiency = $projectedMonthly > 0 ? (($projectedMonthly - $currentExpenses) / $projectedMonthly) * 100 : 0;
        
        if ($efficiency > 10) return 'Sangat Baik';
        if ($efficiency > 0) return 'Baik';
        if ($efficiency > -10) return 'Normal';
        return 'Perlu Perhatian';
    }
    
    private function getEfficiencyDescription(float $currentExpenses, float $avgDaily, int $daysInMonth, float $percentageChange): string
    {
        $projectedMonthly = $avgDaily * $daysInMonth;
        $difference = $projectedMonthly - $currentExpenses;
        $trend = $percentageChange >= 0 ? 'meningkat' : 'menurun';
        
        if ($difference > 0) {
            return 'Hemat Rp ' . number_format(abs($difference), 0, ',', '.') . ' • Tren ' . $trend;
        } else {
            return 'Lebih Rp ' . number_format(abs($difference), 0, ',', '.') . ' • Tren ' . $trend;
        }
    }
    
    private function getEfficiencyColor(float $percentageChange): string
    {
        if ($percentageChange < -5) return 'success';
        if ($percentageChange < 5) return 'info';
        if ($percentageChange < 15) return 'warning';
        return 'danger';
    }

    public static function canView(): bool
    {
        return Auth::check();
    }
}