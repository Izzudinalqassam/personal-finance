<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use App\Models\Category;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseCategoryWidget extends ChartWidget
{
    protected ?string $heading = 'Pengeluaran per Kategori';
    protected string $color = 'info';
    protected ?string $pollingInterval = '30s';
    protected static bool $isLazy = false;
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 3;

    public ?string $filter = 'current_month';

    protected function getFilters(): ?array
    {
        return [
            'current_month' => 'Bulan Ini',
            'last_month' => 'Bulan Lalu',
            'current_year' => 'Tahun Ini',
            'last_30_days' => '30 Hari Terakhir',
        ];
    }

    protected function getData(): array
    {
        $userId = Auth::id();
        $dateRange = $this->getDateRange();
        
        $categoryData = Transaction::select(
                'categories.name as category_name',
                'categories.color as category_color',
                DB::raw('SUM(transactions.amount) as total_amount')
            )
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->where('transactions.user_id', $userId)
            ->where('transactions.type', 'expense')
            ->whereBetween('transactions.transaction_date', $dateRange)
            ->groupBy('categories.id', 'categories.name', 'categories.color')
            ->orderBy('total_amount', 'desc')
            ->limit(10) // Limit to top 10 categories
            ->get();

        if ($categoryData->isEmpty()) {
            return [
                'datasets' => [
                    [
                        'data' => [1],
                        'backgroundColor' => ['#e5e7eb'],
                        'borderWidth' => 0,
                    ]
                ],
                'labels' => ['Tidak ada data'],
            ];
        }

        $labels = [];
        $data = [];
        $colors = [];
        $totalAmount = $categoryData->sum('total_amount');

        foreach ($categoryData as $category) {
            $percentage = ($category->total_amount / $totalAmount) * 100;
            $labels[] = $category->category_name . ' (' . number_format($percentage, 1) . '%)';
            $data[] = (float) $category->total_amount;
            $colors[] = $category->category_color ?? $this->generateRandomColor();
        }

        return [
            'datasets' => [
                [
                    'data' => $data,
                    'backgroundColor' => $colors,
                    'borderWidth' => 2,
                    'borderColor' => '#ffffff',
                    'hoverBorderWidth' => 3,
                    'hoverBorderColor' => '#ffffff',
                ]
            ],
            'labels' => $labels,
        ];
    }

    private function getDateRange(): array
    {
        switch ($this->filter) {
            case 'current_month':
                return [
                    Carbon::now()->startOfMonth(),
                    Carbon::now()->endOfMonth()
                ];
            case 'last_month':
                return [
                    Carbon::now()->subMonth()->startOfMonth(),
                    Carbon::now()->subMonth()->endOfMonth()
                ];
            case 'current_year':
                return [
                    Carbon::now()->startOfYear(),
                    Carbon::now()->endOfYear()
                ];
            case 'last_30_days':
                return [
                    Carbon::now()->subDays(30),
                    Carbon::now()
                ];
            default:
                return [
                    Carbon::now()->startOfMonth(),
                    Carbon::now()->endOfMonth()
                ];
        }
    }

    private function generateRandomColor(): string
    {
        $colors = [
            '#ef4444', '#f97316', '#f59e0b', '#eab308', '#84cc16',
            '#22c55e', '#10b981', '#14b8a6', '#06b6d4', '#0ea5e9',
            '#3b82f6', '#6366f1', '#8b5cf6', '#a855f7', '#d946ef',
            '#ec4899', '#f43f5e', '#64748b', '#6b7280', '#374151'
        ];
        
        return $colors[array_rand($colors)];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                    'labels' => [
                        'usePointStyle' => true,
                        'padding' => 20,
                        'font' => [
                            'size' => 12
                        ]
                    ]
                ],
                'tooltip' => [
                    'enabled' => true,
                ]
            ],
            'cutout' => '60%',
            'radius' => '90%',
            'animation' => [
                'animateRotate' => true,
                'animateScale' => true,
                'duration' => 1000
            ],
            'elements' => [
                'arc' => [
                    'borderWidth' => 2
                ]
            ]
        ];
    }

    public static function canView(): bool
    {
        return Auth::check();
    }

    public function getDescription(): ?string
    {
        $userId = Auth::id();
        $dateRange = $this->getDateRange();
        
        $totalExpenses = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereBetween('transaction_date', $dateRange)
            ->sum('amount');

        $transactionCount = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereBetween('transaction_date', $dateRange)
            ->count();

        return 'Total: Rp ' . number_format($totalExpenses, 0, ',', '.') . ' dari ' . $transactionCount . ' transaksi';
    }
}