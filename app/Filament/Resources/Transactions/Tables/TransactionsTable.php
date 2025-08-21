<?php

namespace App\Filament\Resources\Transactions\Tables;

use App\Models\Transaction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                return $query->where('user_id', Auth::id());
            })
            ->columns([
                TextColumn::make('transaction_date')
                    ->label('Date')
                    ->date('M d, Y')
                    ->sortable()
                    ->searchable(),

                BadgeColumn::make('type')
                    ->label('Type')
                    ->colors([
                        'success' => 'income',
                        'danger' => 'expense',
                        'warning' => 'transfer',
                    ])
                    ->icons([
                        'heroicon-o-arrow-trending-up' => 'income',
                        'heroicon-o-arrow-trending-down' => 'expense',
                        'heroicon-o-arrows-right-left' => 'transfer',
                    ])
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Description')
                    ->searchable()
                    ->limit(30)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 30) {
                            return null;
                        }
                        return $state;
                    }),

                TextColumn::make('account.name')
                    ->label('From Account')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('toAccount.name')
                    ->label('To Account')
                    ->searchable()
                    ->placeholder('—')
                    ->visible(fn ($record) => $record?->type === 'transfer'),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->placeholder('—')
                    ->visible(fn ($record) => $record?->type !== 'transfer'),

                TextColumn::make('amount')
                    ->label('Amount')
                    ->money('IDR')
                    ->sortable()
                    ->color(function ($record) {
                        return match ($record->type) {
                            'income' => 'success',
                            'expense' => 'danger',
                            'transfer' => 'warning',
                            default => 'gray',
                        };
                    })
                    ->weight('bold'),

                TextColumn::make('reference_number')
                    ->label('Reference')
                    ->searchable()
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Transaction Type')
                    ->options(Transaction::getTypes())
                    ->multiple(),

                SelectFilter::make('account_id')
                    ->label('Account')
                    ->relationship('account', 'name', function (Builder $query) {
                        return $query->where('user_id', Auth::id());
                    })
                    ->multiple(),

                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name', function (Builder $query) {
                        return $query->where('user_id', Auth::id());
                    })
                    ->multiple(),

                Filter::make('transaction_date')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('from')
                            ->label('From Date'),
                        \Filament\Forms\Components\DatePicker::make('until')
                            ->label('Until Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('transaction_date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('transaction_date', '<=', $date),
                            );
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('transaction_date', 'desc')
            ->striped();
    }
}
