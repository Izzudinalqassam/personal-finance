<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
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
        'color',
        'icon',
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
        'is_active' => 'boolean',
    ];

    /**
     * Get the user that owns the category.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the transactions for the category.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get available category types.
     *
     * @return array<string, string>
     */
    public static function getTypes(): array
    {
        return [
            'income' => 'Income',
            'expense' => 'Expense',
            'transfer' => 'Transfer',
        ];
    }

    /**
     * Get available colors for categories.
     *
     * @return array<string, string>
     */
    public static function getColors(): array
    {
        return [
            'blue' => 'Blue',
            'green' => 'Green',
            'red' => 'Red',
            'yellow' => 'Yellow',
            'purple' => 'Purple',
            'pink' => 'Pink',
            'indigo' => 'Indigo',
            'gray' => 'Gray',
        ];
    }
}
