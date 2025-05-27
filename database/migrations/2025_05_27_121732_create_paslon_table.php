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
       Schema::create('paslon', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('nomor_urut')->unique();
            $table->string('nama');
            $table->string('gambar')->nullable();
            $table->text('visi_misi');
            $table->unsignedInteger('total_pemilih')->default(0);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paslon');
    }
};
