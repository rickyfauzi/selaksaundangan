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
        Schema::create('fitur_undangan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_fitur'); // contoh: 'galeri', 'cerita_cinta', 'amplop_digital'
            $table->boolean('is_active')->default(true); // Default-nya semua fitur aktif
            $table->timestamps();

            // Membuat kombinasi user_id dan nama_fitur menjadi unik
            $table->unique(['user_id', 'nama_fitur']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fitur_undangan');
    }
};
