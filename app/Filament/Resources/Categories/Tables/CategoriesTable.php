<?php

namespace App\Filament\Resources\Categories\Tables;

use App\Models\Category;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                return $query->where('user_id', Auth::id());
            })
            ->columns([
                TextColumn::make('name')
                    ->label('Category Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                BadgeColumn::make('type')
                    ->label('Type')
                    ->colors([
                        'success' => 'income',
                        'danger' => 'expense',
                    ])
                    ->icons([
                        'heroicon-o-arrow-trending-up' => 'income',
                        'heroicon-o-arrow-trending-down' => 'expense',
                    ])
                    ->sortable(),

                ColorColumn::make('color')
                    ->label('Color')
                    ->sortable(),

                TextColumn::make('icon')
                    ->label('Icon')
                    ->placeholder('—')
                    ->limit(20)
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

                TextColumn::make('transactions_count')
                    ->label('Transactions')
                    ->counts('transactions')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Category Type')
                    ->options(Category::getTypes())
                    ->multiple(),

                TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('All categories')
                    ->trueLabel('Active only')
                    ->falseLabel('Inactive only'),

                SelectFilter::make('color')
                    ->label('Color')
                    ->options(Category::getColors())
                    ->multiple(),
            ])
            ->recordActions([
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
