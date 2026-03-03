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
        Schema::create('companies', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('uid', 100)->unique()->index();
            $blueprint->string('name', 255);
            $blueprint->string('subdomain', 100)->unique()->index();
            $blueprint->string('domain', 255)->nullable()->unique();
            $blueprint->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $blueprint->foreignId('current_plan_id')->nullable()->constrained('plans','id')->onDelete('cascade');
            $blueprint->string('email', 255)->nullable();
            $blueprint->string('phone1', 30)->nullable();
            $blueprint->string('phone2', 30)->nullable();
            $blueprint->string('address', 255)->nullable();
            $blueprint->string('logo', 500)->nullable();
            $blueprint->enum('status', ['active', 'suspended', 'cancelled', 'trial'])->default('trial');
            $blueprint->timestamp('trial_ends_at')->nullable();
            $blueprint->string('timezone', 100)->default('UTC');
            $blueprint->timestamps();
            $blueprint->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
