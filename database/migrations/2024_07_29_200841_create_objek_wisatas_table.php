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
        Schema::create('objek_wisatas', function (Blueprint $table) {
            $table->id();
            $table->string('nama',100);
            $table->foreignId('kategori_id')->constrained('kategori_wisatas')->onDelete('cascade');
            $table->longText('detail');
            $table->foreignId('daerah_id')->constrained('daerahs')->onDelete('cascade');
            $table->text('url_peta')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreignId('penulis_id')->constrained('pegawais')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objek_wisatas');
    }
};
