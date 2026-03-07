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
        Schema::table('subscription_history', function (Blueprint $table) {
            $table->dropForeign(['subscription_id']);
        });

        Schema::table('subscription_history', function (Blueprint $table) {
            // Make the column nullable
            $table->unsignedBigInteger('subscription_id')->nullable()->change();

            // Re-add the foreign key with ON DELETE SET NULL
            $table->foreign('subscription_id')->nullable()->references('id')->on('subscriptions')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscription_history', function (Blueprint $table) {
            $table->dropForeign(['subscription_id']);
        });

        Schema::table('subscription_history', function (Blueprint $table) {
            $table->unsignedBigInteger('subscription_id')->nullable(false)->change();
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
        });
    }
};
