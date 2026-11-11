<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('study_recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('recommendation_date');
            $table->unsignedSmallInteger('recommended_minutes');
            $table->string('reason', 255);
            $table->timestamp('created_at')->useCurrent();
            
            $table->unique(['user_id', 'recommendation_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('study_recommendations');
    }
};