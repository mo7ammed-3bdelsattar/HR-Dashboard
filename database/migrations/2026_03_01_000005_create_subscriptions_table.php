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
        Schema::create('subscriptions', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $blueprint->foreignId('plan_id')->constrained('plans')->onDelete('cascade');
            $blueprint->enum('status', ['active', 'expired', 'cancelled', 'past_due', 'trial'])->default('trial');
            $blueprint->enum('billing_cycle', ['monthly', 'yearly', 'custom'])->default('monthly');
            $blueprint->decimal('price_paid', 10, 2);
            $blueprint->string('currency', 3)->default('USD');
            $blueprint->timestamp('starts_at')->nullable();
            $blueprint->timestamp('ends_at')->nullable()->index();
            $blueprint->timestamp('trial_ends_at')->nullable();
            $blueprint->timestamp('cancelled_at')->nullable();
            $blueprint->timestamp('renewed_at')->nullable();
            $blueprint->unsignedInteger('max_employees_override')->nullable();
            $blueprint->text('notes')->nullable();
            $blueprint->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
