<?php

namespace App\Filament\Resources\Budgets;

use App\Filament\Resources\Budgets\Pages\CreateBudget;
use App\Filament\Resources\Budgets\Pages\EditBudget;
use App\Filament\Resources\Budgets\Pages\ListBudgets;
use App\Filament\Resources\Budgets\Schemas\BudgetForm;
use App\Filament\Resources\Budgets\Tables\BudgetsTable;
use App\Models\Budget;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class BudgetResource extends Resource
{
    protected static ?string $model = Budget::class;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedCurrencyDollar;
    
    protected static ?string $navigationLabel = 'Budgets';
    
    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return BudgetForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BudgetsTable::configure($table);
    }
    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::id());
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBudgets::route('/'),
            'create' => CreateBudget::route('/create'),
            'edit' => EditBudget::route('/{record}/edit'),
        ];
    }
    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('user_id', Auth::id())
                                 ->where('is_active', true)
                                 ->count();
    }
    
    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'success';
    }
}
