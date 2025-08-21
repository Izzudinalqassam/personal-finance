<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->decimal('amount', 15, 2);
            $table->enum('period_type', ['daily', 'weekly', 'monthly', 'quarterly', 'yearly', 'custom']);
            $table->date('start_date');
            $table->date('end_date');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->decimal('alert_threshold', 5, 2)->default(80.00); // Percentage
            $table->boolean('alert_enabled')->default(true);
            $table->timestamps();
            
            // Indexes for better performance
            $table->index(['user_id', 'is_active']);
            $table->index(['category_id', 'start_date', 'end_date']);
            $table->index(['period_type', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
