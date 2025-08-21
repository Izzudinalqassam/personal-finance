<?php

namespace App\Filament\Resources\Accounts\Schemas;

use App\Models\Account;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class AccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->default(Auth::id())
                            ->disabled()
                            ->dehydrated()
                            ->required(),

                        TextInput::make('name')
                            ->label('Account Name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Main Savings, Cash Wallet')
                            ->unique(ignoreRecord: true)
                            ->validationAttribute('account name'),

                        Select::make('type')
                            ->label('Account Type')
                            ->options(Account::getTypes())
                            ->required()
                            ->native(false)
                            ->placeholder('Select account type'),

                        TextInput::make('balance')
                            ->label('Initial Balance')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->step(0.01)
                            ->prefix('IDR')
                            ->placeholder('0.00')
                            ->validationAttribute('balance'),

                        Select::make('currency')
                            ->label('Currency')
                            ->options(Account::getCurrencies())
                            ->required()
                            ->default('IDR')
                            ->native(false),

                        Toggle::make('is_active')
                            ->label('Active Account')
                            ->default(true)
                            ->helperText('Inactive accounts cannot be used for new transactions'),
                    ]),

                Textarea::make('description')
                    ->label('Description')
                    ->placeholder('Optional description for this account')
                    ->maxLength(500)
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
