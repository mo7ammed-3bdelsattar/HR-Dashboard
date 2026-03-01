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
        Schema::create('subscription_history', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $blueprint->foreignId('subscription_id')->constrained('subscriptions')->onDelete('cascade');
            $blueprint->foreignId('old_plan_id')->nullable()->constrained('plans')->onDelete('set null');
            $blueprint->foreignId('new_plan_id')->nullable()->constrained('plans')->onDelete('set null');
            $blueprint->enum('action', ['created', 'upgraded', 'downgraded', 'renewed', 'cancelled', 'suspended']);
            $blueprint->foreignId('changed_by')->nullable()->constrained('users')->onDelete('set null');
            $blueprint->text('reason')->nullable();
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_history');
    }
};
