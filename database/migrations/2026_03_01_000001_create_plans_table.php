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
        Schema::create('plans', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('name', 100);
            $blueprint->string('slug', 100)->unique();
            $blueprint->text('description')->nullable();
            $blueprint->decimal('price_monthly', 10, 2);
            $blueprint->decimal('price_yearly', 10, 2);
            $blueprint->string('currency', 3)->default('USD');
            $blueprint->unsignedInteger('max_employees')->nullable()->comment('NULL = unlimited');
            $blueprint->unsignedInteger('duration_days')->comment('30, 365, etc.');
            $blueprint->boolean('is_active')->default(true);
            $blueprint->boolean('is_featured')->default(false);
            $blueprint->integer('sort_order')->default(0);
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
