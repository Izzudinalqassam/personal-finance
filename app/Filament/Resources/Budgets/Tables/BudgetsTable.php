<?php

namespace App\Filament\Resources\Budgets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BudgetsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Budget Name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                
                TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn ($record) => $record->category->color ?? 'gray'),
                
                TextColumn::make('amount')
                    ->label('Budget Amount')
                    ->money('IDR')
                    ->sortable(),
                
                TextColumn::make('spent_amount')
                    ->label('Spent')
                    ->money('IDR')
                    ->color(fn ($record) => $record->is_over_budget ? 'danger' : 'success'),
                
                TextColumn::make('usage_percentage')
                    ->label('Progress')
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
                
                TextColumn::make('remaining_amount')
                    ->label('Remaining')
                    ->money('IDR')
                    ->color(fn ($record) => $record->remaining_amount < 0 ? 'danger' : 'success'),
                
                BadgeColumn::make('period_type')
                    ->label('Period')
                    ->colors([
                        'primary' => 'monthly',
                        'secondary' => 'weekly',
                        'success' => 'yearly',
                    ]),
                
                BadgeColumn::make('status')
                    ->label('Status')
                    ->getStateUsing(function ($record) {
                        if (!$record->is_active) return 'inactive';
                        if ($record->is_over_budget) return 'over_budget';
                        if ($record->usage_percentage >= $record->alert_threshold) return 'warning';
                        return 'active';
                    })
                    ->colors([
                        'success' => 'active',
                        'warning' => 'warning',
                        'danger' => 'over_budget',
                        'gray' => 'inactive',
                    ]),
                
                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date()
                    ->sortable(),
                
                TextColumn::make('end_date')
                    ->label('End Date')
                    ->date()
                    ->sortable(),
                
                IconColumn::make('alert_enabled')
                    ->label('Alerts')
                    ->boolean()
                    ->trueIcon('heroicon-o-bell')
                    ->falseIcon('heroicon-o-bell-slash'),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'over_budget' => 'Over Budget',
                        'warning' => 'Warning',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        if (!$data['value']) return $query;
                        
                        return match ($data['value']) {
                            'active' => $query->where('is_active', true)
                                             ->where('is_over_budget', false)
                                             ->whereRaw('usage_percentage < alert_threshold'),
                            'inactive' => $query->where('is_active', false),
                            'over_budget' => $query->where('is_over_budget', true),
                            'warning' => $query->where('is_active', true)
                                              ->where('is_over_budget', false)
                                              ->whereRaw('usage_percentage >= alert_threshold'),
                            default => $query,
                        };
                    }),
                
                Filter::make('over_budget')
                    ->label('Over Budget')
                    ->query(fn (Builder $query): Builder => $query->where('is_over_budget', true)),
                
                Filter::make('alert_triggered')
                    ->label('Alert Triggered')
                    ->query(fn (Builder $query): Builder => $query->whereRaw('usage_percentage >= alert_threshold')),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
