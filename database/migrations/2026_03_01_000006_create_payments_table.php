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
        Schema::create('payments', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('subscription_id')->constrained('subscriptions')->onDelete('cascade');
            $blueprint->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $blueprint->decimal('amount', 10, 2);
            $blueprint->string('currency', 3)->default('USD');
            $blueprint->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $blueprint->string('payment_method', 50)->nullable();
            $blueprint->string('transaction_id', 255)->nullable();
            $blueprint->timestamp('payment_date')->nullable();
            $blueprint->timestamp('due_date')->nullable();
            $blueprint->string('invoice_number', 100)->unique();
            $blueprint->string('invoice_path', 500)->nullable();
            $blueprint->text('notes')->nullable();
            $blueprint->foreignId('received_by')->nullable()->constrained('users')->onDelete('set null');
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
