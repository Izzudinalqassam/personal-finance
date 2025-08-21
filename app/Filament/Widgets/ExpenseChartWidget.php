<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class ExpenseChartWidget extends ChartWidget
{
    protected ?string $heading = 'Tren Pengeluaran';
    protected string $color = 'danger';
    protected ?string $pollingInterval = '30s';
    protected static bool $isLazy = false;
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 2;

    public ?string $filter = '30days';

    protected function getFilters(): ?array
    {
        return [
            '7days' => '7 Hari Terakhir',
            '30days' => '30 Hari Terakhir',
            '90days' => '3 Bulan Terakhir',
            'year' => 'Tahun Ini',
        ];
    }

    protected function getData(): array
    {
        $userId = Auth::id();
        $filter = $this->filter;
        
        switch ($filter) {
            case '7days':
                return $this->getDailyData($userId, 7);
            case '30days':
                return $this->getDailyData($userId, 30);
            case '90days':
                return $this->getWeeklyData($userId, 12);
            case 'year':
                return $this->getMonthlyData($userId);
            default:
                return $this->getDailyData($userId, 30);
        }
    }

    private function getDailyData(int $userId, int $days): array
    {
        $labels = [];
        $data = [];
        
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('d M');
            
            // Get total amount
            $amount = Transaction::where('user_id', $userId)
                ->where('type', 'expense')
                ->whereDate('transaction_date', $date)
                ->sum('amount');
            
            $data[] = (float) $amount;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pengeluaran Harian',
                    'data' => $data,
                    'borderColor' => '#ef4444',
                    'backgroundColor' => 'rgba(239, 68, 68, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                    'pointBackgroundColor' => '#ef4444',
                    'pointBorderColor' => '#ffffff',
                    'pointBorderWidth' => 2,
                    'pointRadius' => 4,
                    'pointHoverRadius' => 6,

                ],
            ],
            'labels' => $labels,
        ];
    }

    private function getWeeklyData(int $userId, int $weeks): array
    {
        $labels = [];
        $data = [];
        
        for ($i = $weeks - 1; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
            $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();
            
            $labels[] = $startOfWeek->format('d M') . ' - ' . $endOfWeek->format('d M');
            
            $amount = Transaction::where('user_id', $userId)
                ->where('type', 'expense')
                ->whereBetween('transaction_date', [$startOfWeek, $endOfWeek])
                ->sum('amount');
            
            $data[] = (float) $amount;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pengeluaran Mingguan',
                    'data' => $data,
                    'borderColor' => '#f59e0b',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                    'pointBackgroundColor' => '#f59e0b',
                    'pointBorderColor' => '#ffffff',
                    'pointBorderWidth' => 2,
                    'pointRadius' => 4,
                    'pointHoverRadius' => 6,
                ],
            ],
            'labels' => $labels,
        ];
    }

    private function getMonthlyData(int $userId): array
    {
        $labels = [];
        $data = [];
        
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $labels[] = $date->format('M Y');
            
            $amount = Transaction::where('user_id', $userId)
                ->where('type', 'expense')
                ->whereYear('transaction_date', $date->year)
                ->whereMonth('transaction_date', $date->month)
                ->sum('amount');
            
            $data[] = (float) $amount;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pengeluaran Bulanan',
                    'data' => $data,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                    'pointBackgroundColor' => '#3b82f6',
                    'pointBorderColor' => '#ffffff',
                    'pointBorderWidth' => 2,
                    'pointRadius' => 4,
                    'pointHoverRadius' => 6,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'devicePixelRatio' => 2,
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                    'labels' => [
                        'usePointStyle' => true,
                        'padding' => 20,
                    ]
                ],
                'tooltip' => [
                    'enabled' => true,
                    'mode' => 'index',
                    'intersect' => false,
                    'backgroundColor' => 'rgba(0, 0, 0, 0.9)',
                    'titleColor' => '#ffffff',
                    'bodyColor' => '#ffffff',
                    'borderColor' => '#ef4444',
                    'borderWidth' => 1,
                    'cornerRadius' => 8,
                    'displayColors' => false,
                    'animation' => [
                        'duration' => 200,
                    ],
                    'titleFont' => [
                        'size' => 14
                    ],
                    'bodyFont' => [
                        'size' => 13
                    ],
                    'padding' => 12,

                ],
                'zoom' => [
                    'limits' => [
                        'y' => ['min' => 0, 'max' => 'original'],
                        'x' => ['min' => 'original', 'max' => 'original']
                    ],
                    'pan' => [
                        'enabled' => true,
                        'mode' => 'x',
                        'modifierKey' => 'ctrl',
                    ],
                    'zoom' => [
                        'wheel' => [
                            'enabled' => true,
                            'speed' => 0.1,
                        ],
                        'pinch' => [
                            'enabled' => true
                        ],
                        'mode' => 'x',
                    ]
                ]
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'grid' => [
                        'color' => 'rgba(0, 0, 0, 0.1)',
                        'lineWidth' => 1,
                    ],
                    'ticks' => [
                        'maxTicksLimit' => 6,
                    ]
                ],
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                    'ticks' => [
                        'maxRotation' => 45,
                        'minRotation' => 0,
                    ]
                ]
            ],
            'interaction' => [
                'mode' => 'nearest',
                'axis' => 'x',
                'intersect' => false,
            ],

            'animation' => [
                'duration' => 1000,
                'easing' => 'easeInOutQuart',
            ],
            'elements' => [
                'point' => [
                    'hoverRadius' => 8,
                    'hoverBorderWidth' => 3,
                ],
                'line' => [
                    'borderWidth' => 3,
                ]
            ]
        ];
    }

    public static function canView(): bool
    {
        return Auth::check();
    }
}