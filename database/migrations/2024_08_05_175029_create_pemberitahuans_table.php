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
        Schema::create('pemberitahuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengirim_id')->constrained('pegawais')->onDelete('cascade');
            $table->foreignId('penerima_id')->constrained('agen_travel')->onDelete('cascade');
            $table->string('perihal');
            $table->text('isi');
            $table->string('lampiran')->nullable(); // Jika ada lampiran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemberitahuans');
    }
};
