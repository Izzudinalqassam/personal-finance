<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'amount',
        'period_type',
        'start_date',
        'end_date',
        'description',
        'is_active',
        'alert_threshold',
        'alert_enabled',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'alert_threshold' => 'decimal:2',
        'alert_enabled' => 'boolean',
    ];

    /**
     * Get the user that owns the budget.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that this budget belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the transactions for this budget's category within the budget period.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'category_id', 'category_id')
            ->where('user_id', $this->user_id)
            ->whereBetween('transaction_date', [$this->start_date, $this->end_date]);
    }

    /**
     * Calculate total spent amount for this budget period.
     */
    public function getSpentAmountAttribute(): float
    {
        return $this->transactions()
            ->where('type', 'expense')
            ->sum('amount') ?? 0;
    }

    /**
     * Calculate remaining budget amount.
     */
    public function getRemainingAmountAttribute(): float
    {
        return $this->amount - $this->spent_amount;
    }

    /**
     * Calculate budget usage percentage.
     */
    public function getUsagePercentageAttribute(): float
    {
        if ($this->amount <= 0) {
            return 0;
        }
        
        return round(($this->spent_amount / $this->amount) * 100, 2);
    }

    /**
     * Check if budget is over the limit.
     */
    public function getIsOverBudgetAttribute(): bool
    {
        return $this->spent_amount > $this->amount;
    }

    /**
     * Check if budget has reached alert threshold.
     */
    public function getIsAlertTriggeredAttribute(): bool
    {
        if (!$this->alert_enabled || $this->alert_threshold <= 0) {
            return false;
        }
        
        return $this->usage_percentage >= $this->alert_threshold;
    }

    /**
     * Get budget status (active, expired, upcoming).
     */
    public function getStatusAttribute(): string
    {
        $now = Carbon::now()->toDateString();
        
        if (!$this->is_active) {
            return 'inactive';
        }
        
        if ($now < $this->start_date->toDateString()) {
            return 'upcoming';
        }
        
        if ($now > $this->end_date->toDateString()) {
            return 'expired';
        }
        
        return 'active';
    }

    /**
     * Scope to get active budgets.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get current budgets (within date range).
     */
    public function scopeCurrent($query)
    {
        $now = Carbon::now()->toDateString();
        return $query->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now);
    }

    /**
     * Scope to get budgets for specific user.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope to get budgets by period type.
     */
    public function scopeByPeriod($query, $periodType)
    {
        return $query->where('period_type', $periodType);
    }
}