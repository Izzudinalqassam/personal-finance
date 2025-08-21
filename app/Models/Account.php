<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'balance',
        'currency',
        'description',
        'user_id',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'balance' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user that owns the account.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the transactions for the account.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the account types.
     *
     * @return array<string, string>
     */
    public static function getTypes(): array
    {
        return [
            'checking' => 'Checking Account',
            'savings' => 'Savings Account',
            'credit_card' => 'Credit Card',
            'cash' => 'Cash',
            'investment' => 'Investment Account',
            'loan' => 'Loan Account',
        ];
    }

    /**
     * Get the currencies.
     *
     * @return array<string, string>
     */
    public static function getCurrencies(): array
    {
        return [
            'IDR' => 'Indonesian Rupiah',
            'USD' => 'US Dollar',
            'EUR' => 'Euro',
            'GBP' => 'British Pound',
            'JPY' => 'Japanese Yen',
        ];
    }
}
