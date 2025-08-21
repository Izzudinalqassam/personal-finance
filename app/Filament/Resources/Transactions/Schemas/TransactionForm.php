<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        Select::make('type')
                            ->label('Transaction Type')
                            ->options(Transaction::getTypes())
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('category_id', null);
                                $set('to_account_id', null);
                            }),

                        DatePicker::make('transaction_date')
                            ->label('Transaction Date')
                            ->required()
                            ->default(now())
                            ->maxDate(now()),
                    ]),

                Grid::make(2)
                    ->schema([
                        Select::make('account_id')
                            ->label('From Account')
                            ->relationship('account', 'name', function ($query) {
                                return $query->where('user_id', Auth::id())
                                           ->where('is_active', true);
                            })
                            ->required()
                            ->searchable()
                            ->preload(),

                        Select::make('to_account_id')
                            ->label('To Account')
                            ->relationship('toAccount', 'name', function ($query) {
                                return $query->where('user_id', Auth::id())
                                           ->where('is_active', true);
                            })
                            ->searchable()
                            ->preload()
                            ->visible(fn (Get $get): bool => $get('type') === 'transfer')
                            ->required(fn (Get $get): bool => $get('type') === 'transfer'),
                    ]),

                Grid::make(2)
                    ->schema([
                        Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'name', function ($query, Get $get) {
                                return $query->where('user_id', Auth::id())
                                           ->where('is_active', true)
                                           ->when($get('type'), function ($query, $type) {
                                               if ($type !== 'transfer') {
                                                   $query->where('type', $type);
                                               }
                                           });
                            })
                            ->required(fn (Get $get): bool => $get('type') !== 'transfer')
                            ->searchable()
                            ->preload()
                            ->visible(fn (Get $get): bool => $get('type') !== 'transfer'),

                        TextInput::make('amount')
                            ->label('Amount')
                            ->required()
                            ->numeric()
                            ->minValue(0.01)
                            ->step(0.01)
                            ->prefix('IDR')
                            ->placeholder('0.00'),
                    ]),

                TextInput::make('description')
                    ->label('Description')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Enter transaction description'),

                Grid::make(2)
                    ->schema([
                        TextInput::make('reference_number')
                            ->label('Reference Number')
                            ->maxLength(100)
                            ->placeholder('Optional reference number'),

                        Select::make('user_id')
                            ->label('User')
                            ->relationship('user', 'name')
                            ->default(Auth::id())
                            ->required()
                            ->disabled()
                            ->dehydrated(),
                    ]),

                Textarea::make('notes')
                    ->label('Notes')
                    ->rows(3)
                    ->placeholder('Additional notes (optional)')
                    ->columnSpanFull(),
            ]);
    }
}
