<?php

namespace App\Filament\Resources\Accounts\Schemas;

use Filament\Schemas\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AccountInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Account Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Account Name')
                                    ->weight('bold')
                                    ->size('lg'),

                                TextEntry::make('type')
                                    ->label('Account Type')
                                    ->badge()
                                    ->color(function ($record) {
                                        return match ($record->type) {
                                            'savings' => 'primary',
                                            'checking' => 'success',
                                            'cash' => 'warning',
                                            'investment' => 'info',
                                            'credit_card' => 'secondary',
                                            default => 'gray',
                                        };
                                    }),

                                TextEntry::make('balance')
                                    ->label('Current Balance')
                                    ->money('IDR')
                                    ->size('lg')
                                    ->weight('bold')
                                    ->color(function ($record) {
                                        return $record->balance >= 0 ? 'success' : 'danger';
                                    }),

                                TextEntry::make('currency')
                                    ->label('Currency')
                                    ->badge()
                                    ->color('gray'),

                                IconEntry::make('is_active')
                                    ->label('Status')
                                    ->boolean()
                                    ->trueIcon('heroicon-o-check-circle')
                                    ->falseIcon('heroicon-o-x-circle')
                                    ->trueColor('success')
                                    ->falseColor('danger'),
                            ]),

                        TextEntry::make('description')
                            ->label('Description')
                            ->placeholder('No description provided')
                            ->columnSpanFull(),
                    ])
                    ->icon('heroicon-o-banknotes'),

                Section::make('Account Details')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('user.name')
                                    ->label('Account Owner')
                                    ->icon('heroicon-o-user'),

                                TextEntry::make('created_at')
                                    ->label('Created At')
                                    ->dateTime('M d, Y H:i')
                                    ->icon('heroicon-o-calendar'),

                                TextEntry::make('updated_at')
                                    ->label('Last Updated')
                                    ->dateTime('M d, Y H:i')
                                    ->icon('heroicon-o-clock'),
                            ]),
                    ])
                    ->icon('heroicon-o-information-circle')
                    ->collapsible(),
            ]);
    }
}
