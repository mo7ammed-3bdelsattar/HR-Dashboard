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
        Schema::create('plan_features', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('plan_id')->constrained('plans')->onDelete('cascade');
            $blueprint->string('feature_key', 100);
            $blueprint->string('feature_value', 255);
            $blueprint->string('label', 200)->nullable();
            $blueprint->timestamps();
            
            $blueprint->index(['plan_id', 'feature_key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_features');
    }
};
