<?php

namespace App\Filament\Widgets;

use App\Models\Budget;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class BudgetChartWidget extends ChartWidget
{
    protected ?string $heading = 'Budget vs Spending Overview';
    
    protected static ?int $sort = 2;
    
    protected int | string | array $columnSpan = 'full';
    
    protected function getData(): array
    {
        $budgets = Budget::where('is_active', true)
            ->orderBy('usage_percentage', 'desc')
            ->limit(10)
            ->get();
        
        $labels = $budgets->pluck('name')->toArray();
        $budgetAmounts = $budgets->pluck('amount')->toArray();
        $spentAmounts = $budgets->pluck('spent_amount')->toArray();
        $remainingAmounts = $budgets->map(function ($budget) {
            return max(0, $budget->amount - $budget->spent_amount);
        })->toArray();
        
        return [
            'datasets' => [
                [
                    'label' => 'Budget Amount',
                    'data' => $budgetAmounts,
                    'backgroundColor' => 'rgba(59, 130, 246, 0.5)',
                    'borderColor' => 'rgb(59, 130, 246)',
                    'borderWidth' => 2,
                ],
                [
                    'label' => 'Spent Amount',
                    'data' => $spentAmounts,
                    'backgroundColor' => 'rgba(239, 68, 68, 0.5)',
                    'borderColor' => 'rgb(239, 68, 68)',
                    'borderWidth' => 2,
                ],
                [
                    'label' => 'Remaining Amount',
                    'data' => $remainingAmounts,
                    'backgroundColor' => 'rgba(34, 197, 94, 0.5)',
                    'borderColor' => 'rgb(34, 197, 94)',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $labels,
        ];
    }
    
    protected function getType(): string
    {
        return 'bar';
    }
    
    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
                'title' => [
                    'display' => true,
                    'text' => 'Top 10 Budgets - Amount vs Spending Comparison',
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'callback' => 'function(value) { return "Rp " + value.toLocaleString("id-ID"); }',
                    ],
                ],
            ],
            'interaction' => [
                'intersect' => false,
                'mode' => 'index',
            ],
        ];
    }
}