<?php

namespace App\Filament\Resources\Budgets\Schemas;

use App\Models\Category;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BudgetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Budget Information')
                    ->description('Set up your budget details and spending limits')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Budget Name')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('e.g., Monthly Groceries, Entertainment Budget'),
                                
                                Select::make('category_id')
                                    ->label('Category')
                                    ->relationship('category', 'name', fn ($query) => 
                                        $query->where('user_id', Auth::id())
                                              ->where('type', 'expense')
                                              ->where('is_active', true)
                                    )
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                        Select::make('type')
                                            ->options([
                                                'expense' => 'Expense',
                                            ])
                                            ->default('expense')
                                            ->required(),
                                        TextInput::make('color')
                                            ->default('#ef4444'),
                                        TextInput::make('icon')
                                            ->default('heroicon-o-banknotes'),
                                    ])
                                    ->createOptionUsing(function (array $data) {
                                        return Category::create([
                                            ...$data,
                                            'user_id' => Auth::id(),
                                            'is_active' => true,
                                        ])->id;
                                    }),
                            ]),
                        
                        Grid::make(2)
                            ->schema([
                                TextInput::make('amount')
                                    ->label('Budget Amount')
                                    ->required()
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->minValue(0)
                                    ->step(0.01)
                                    ->placeholder('0.00'),
                                
                                Select::make('period_type')
                                    ->label('Budget Period')
                                    ->options([
                                        'daily' => 'Daily',
                                        'weekly' => 'Weekly', 
                                        'monthly' => 'Monthly',
                                        'quarterly' => 'Quarterly',
                                        'yearly' => 'Yearly',
                                        'custom' => 'Custom Period',
                                    ])
                                    ->required()
                                    ->default('monthly')
                                    ->live()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $now = Carbon::now();
                                        
                                        switch ($state) {
                                            case 'daily':
                                                $set('start_date', $now->toDateString());
                                                $set('end_date', $now->toDateString());
                                                break;
                                            case 'weekly':
                                                $set('start_date', $now->startOfWeek()->toDateString());
                                                $set('end_date', $now->endOfWeek()->toDateString());
                                                break;
                                            case 'monthly':
                                                $set('start_date', $now->startOfMonth()->toDateString());
                                                $set('end_date', $now->endOfMonth()->toDateString());
                                                break;
                                            case 'quarterly':
                                                $set('start_date', $now->startOfQuarter()->toDateString());
                                                $set('end_date', $now->endOfQuarter()->toDateString());
                                                break;
                                            case 'yearly':
                                                $set('start_date', $now->startOfYear()->toDateString());
                                                $set('end_date', $now->endOfYear()->toDateString());
                                                break;
                                        }
                                    }),
                            ]),
                        
                        Grid::make(2)
                            ->schema([
                                DatePicker::make('start_date')
                                    ->label('Start Date')
                                    ->required()
                                    ->default(Carbon::now()->startOfMonth())
                                    ->beforeOrEqual('end_date'),
                                
                                DatePicker::make('end_date')
                                    ->label('End Date')
                                    ->required()
                                    ->default(Carbon::now()->endOfMonth())
                                    ->afterOrEqual('start_date'),
                            ]),
                        
                        Textarea::make('description')
                            ->label('Description')
                            ->placeholder('Optional notes about this budget...')
                            ->columnSpanFull()
                            ->rows(3),
                    ]),
                
                Section::make('Budget Settings')
                    ->description('Configure alerts and status')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Toggle::make('is_active')
                                    ->label('Active Budget')
                                    ->default(true)
                                    ->helperText('Enable or disable this budget'),
                                
                                Toggle::make('alert_enabled')
                                    ->label('Enable Alerts')
                                    ->default(true)
                                    ->live()
                                    ->helperText('Get notified when spending approaches limit'),
                                
                                TextInput::make('alert_threshold')
                                    ->label('Alert Threshold (%)')
                                    ->numeric()
                                    ->suffix('%')
                                    ->minValue(1)
                                    ->maxValue(100)
                                    ->default(80)
                                    ->visible(fn ($get) => $get('alert_enabled'))
                                    ->helperText('Alert when spending reaches this percentage'),
                            ]),
                    ]),
            ])
            ->columns(1);
    }
}
