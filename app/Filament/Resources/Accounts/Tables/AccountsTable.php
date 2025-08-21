<?php

namespace App\Filament\Resources\Accounts\Tables;

use App\Models\Account;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AccountsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                return $query->where('user_id', Auth::id());
            })
            ->columns([
                TextColumn::make('name')
                    ->label('Account Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                BadgeColumn::make('type')
                    ->label('Type')
                    ->colors([
                        'primary' => 'savings',
                        'success' => 'checking',
                        'warning' => 'cash',
                        'info' => 'investment',
                        'secondary' => 'credit_card',
                    ])
                    ->icons([
                        'heroicon-o-banknotes' => 'savings',
                        'heroicon-o-credit-card' => 'checking',
                        'heroicon-o-currency-dollar' => 'cash',
                        'heroicon-o-chart-bar' => 'investment',
                        'heroicon-o-identification' => 'credit_card',
                    ])
                    ->sortable(),

                TextColumn::make('balance')
                    ->label('Balance')
                    ->money('IDR')
                    ->sortable()
                    ->color(function ($record) {
                        return $record->balance >= 0 ? 'success' : 'danger';
                    })
                    ->weight('bold'),

                TextColumn::make('currency')
                    ->label('Currency')
                    ->badge()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Description')
                    ->limit(30)
                    ->placeholder('—')
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 30) {
                            return null;
                        }
                        return $state;
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Account Type')
                    ->options(Account::getTypes())
                    ->multiple(),

                TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('All accounts')
                    ->trueLabel('Active only')
                    ->falseLabel('Inactive only'),

                SelectFilter::make('currency')
                    ->label('Currency')
                    ->options(Account::getCurrencies())
                    ->multiple(),
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
            ->defaultSort('name', 'asc')
            ->striped();
    }
}
