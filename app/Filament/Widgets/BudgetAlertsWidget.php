<?php

namespace App\Filament\Widgets;

use App\Models\Budget;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class BudgetAlertsWidget extends BaseWidget
{
    protected static ?string $heading = 'Budget Alerts & Warnings';
    
    protected static ?int $sort = 3;
    
    protected int | string | array $columnSpan = 'full';
    
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Budget::query()
                    ->where('is_active', true)
                    ->where(function (Builder $query) {
                        $query->where('is_over_budget', true)
                            ->orWhere('usage_percentage', '>=', DB::raw('alert_threshold'));
                    })
                    ->orderBy('usage_percentage', 'desc')
            )
            ->columns([
                TextColumn::make('name')
                    ->label('Budget Name')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable(),
                    
                TextColumn::make('amount')
                    ->label('Budget Amount')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),
                    
                TextColumn::make('spent_amount')
                    ->label('Spent Amount')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),
                    
                TextColumn::make('usage_percentage')
                    ->label('Usage %')
                    ->formatStateUsing(function ($state, $record) {
                        $percentage = number_format($state, 1);
                        $color = match (true) {
                            $state >= 100 => 'text-red-600 bg-red-50',
                            $state >= $record->alert_threshold => 'text-yellow-600 bg-yellow-50',
                            default => 'text-green-600 bg-green-50'
                        };
                        return "<div class='inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {$color}'>{$percentage}%</div>";
                    })
                    ->html()
                    ->sortable(),
                    
                BadgeColumn::make('alert_status')
                    ->label('Alert Level')
                    ->getStateUsing(function ($record) {
                        if ($record->is_over_budget) {
                            return 'OVER BUDGET';
                        }
                        if ($record->usage_percentage >= $record->alert_threshold) {
                            return 'WARNING';
                        }
                        return 'NORMAL';
                    })
                    ->colors([
                        'danger' => 'OVER BUDGET',
                        'warning' => 'WARNING',
                        'success' => 'NORMAL',
                    ]),
                    
                TextColumn::make('remaining_amount')
                    ->label('Remaining')
                    ->formatStateUsing(function ($state, $record) {
                        $remaining = $record->amount - $record->spent_amount;
                        $color = $remaining < 0 ? 'text-red-600' : 'text-green-600';
                        return "<span class='{$color}'>Rp " . number_format($remaining, 0, ',', '.') . '</span>';
                    })
                    ->html()
                    ->sortable(),
                    
                TextColumn::make('period_type')
                    ->label('Period')
                    ->badge()
                    ->colors([
                        'primary' => 'monthly',
                        'success' => 'weekly',
                        'warning' => 'yearly',
                        'info' => 'daily',
                    ]),
            ])
            ->defaultSort('usage_percentage', 'desc')
            ->paginated([5, 10, 25])
            ->defaultPaginationPageOption(5);
    }
}