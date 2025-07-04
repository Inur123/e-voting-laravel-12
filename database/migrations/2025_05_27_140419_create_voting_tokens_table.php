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
        Schema::create('voting_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
            $table->boolean('used')->default(false);
            $table->foreignId('paslon_id')->nullable()->constrained('paslon')->nullOnDelete();
            $table->timestamp('used_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voting_tokens');
    }
};
