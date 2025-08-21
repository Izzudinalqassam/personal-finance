<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class ExpenseTrendReportWidget extends BaseWidget
{
    protected static ?string $heading = 'Laporan Tren Pengeluaran';
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    protected static bool $isLazy = false;

    public ?string $filter = '30days';

    protected function getTableFilters(): array
    {
        return [
            Tables\Filters\SelectFilter::make('period')
                ->label('Periode')
                ->options([
                    '7days' => '7 Hari Terakhir',
                    '30days' => '30 Hari Terakhir',
                    '90days' => '90 Hari Terakhir',
                    'year' => 'Tahun Ini',
                ])
                ->default('30days')
                ->query(function (Builder $query, array $data): Builder {
                    $period = $data['value'] ?? '30days';
                    $userId = Auth::id();
                    
                    switch ($period) {
                        case '7days':
                            return $query->where('user_id', $userId)
                                ->where('type', 'expense')
                                ->where('transaction_date', '>=', Carbon::now()->subDays(7));
                        case '30days':
                            return $query->where('user_id', $userId)
                                ->where('type', 'expense')
                                ->where('transaction_date', '>=', Carbon::now()->subDays(30));
                        case '90days':
                            return $query->where('user_id', $userId)
                                ->where('type', 'expense')
                                ->where('transaction_date', '>=', Carbon::now()->subDays(90));
                        case 'year':
                            return $query->where('user_id', $userId)
                                ->where('type', 'expense')
                                ->whereYear('transaction_date', Carbon::now()->year);
                        default:
                            return $query->where('user_id', $userId)
                                ->where('type', 'expense')
                                ->where('transaction_date', '>=', Carbon::now()->subDays(30));
                    }
                }),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Transaction::query()
                    ->where('user_id', Auth::id())
                    ->where('type', 'expense')
                    ->where('transaction_date', '>=', Carbon::now()->subDays(30))
                    ->selectRaw('DATE(transaction_date) as date, SUM(amount) as total_amount, COUNT(*) as transaction_count')
                    ->groupBy('date')
                    ->orderBy('date', 'desc')
            )
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable()
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total Pengeluaran')
                    ->money('IDR')
                    ->sortable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->money('IDR')
                            ->label('Total Keseluruhan'),
                    ]),
                    
                Tables\Columns\TextColumn::make('transaction_count')
                    ->label('Jumlah Transaksi')
                    ->numeric()
                    ->sortable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->numeric()
                            ->label('Total Transaksi'),
                    ]),
                    
                Tables\Columns\TextColumn::make('average_per_transaction')
                    ->label('Rata-rata per Transaksi')
                    ->money('IDR')
                    ->getStateUsing(function ($record) {
                        return $record->transaction_count > 0 
                            ? $record->total_amount / $record->transaction_count 
                            : 0;
                    })
                    ->sortable(false),
            ])
            ->filters($this->getTableFilters())
            ->defaultSort('date', 'desc')
            ->paginated([10, 25, 50])
            ->defaultPaginationPageOption(10)
            ->striped()
            ->emptyStateHeading('Tidak ada data pengeluaran')
            ->emptyStateDescription('Belum ada transaksi pengeluaran untuk periode yang dipilih.')
            ->emptyStateIcon('heroicon-o-chart-bar');
    }

    public static function canView(): bool
    {
        return Auth::check();
    }

    public function getTableRecordKey($record): string
    {
        return (string) $record->date;
    }
}