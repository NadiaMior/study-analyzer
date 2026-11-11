<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('study_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title', 120);
            $table->string('notes', 500)->default('');
            $table->date('plan_date');
            $table->time('plan_time')->nullable();
            $table->timestamp('created_at')->useCurrent();
            
            $table->index(['user_id', 'plan_date', 'plan_time']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('study_plans');
    }
};