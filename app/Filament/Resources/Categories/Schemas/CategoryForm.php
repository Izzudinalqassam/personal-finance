<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Filament\Forms\Components\ColorPicker;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class CategoryForm
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
                            ->label('Category Name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Food & Dining, Transportation')
                            ->unique(ignoreRecord: true)
                            ->validationAttribute('category name'),

                        Select::make('type')
                            ->label('Category Type')
                            ->options(Category::getTypes())
                            ->required()
                            ->native(false)
                            ->placeholder('Select category type')
                            ->helperText('Income categories for money coming in, Expense categories for money going out'),

                        Select::make('color')
                            ->label('Color')
                            ->options(Category::getColors())
                            ->required()
                            ->native(false)
                            ->placeholder('Select a color')
                            ->helperText('Color helps identify categories quickly'),

                        TextInput::make('icon')
                            ->label('Icon')
                            ->placeholder('e.g., heroicon-o-shopping-cart')
                            ->helperText('Heroicon name for visual representation')
                            ->maxLength(100),

                        Toggle::make('is_active')
                            ->label('Active Category')
                            ->default(true)
                            ->helperText('Inactive categories cannot be used for new transactions'),
                    ]),

                Textarea::make('description')
                    ->label('Description')
                    ->placeholder('Optional description for this category')
                    ->maxLength(500)
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
