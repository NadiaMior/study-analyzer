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
        Schema::create('study_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('subject', 100);
            $table->unsignedInteger('planned_seconds');
            $table->unsignedInteger('elapsed_seconds')->default(0);
            $table->enum('status', ['running', 'paused', 'completed', 'cancelled'])->default('running');
            $table->dateTime('started_at');
            $table->dateTime('running_since')->nullable();
            $table->dateTime('ended_at')->nullable();
            
            $table->index(['user_id', 'status']);
            $table->index(['user_id', 'ended_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_sessions');
    }
};