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
    Schema::create('rekam_medis', function (Blueprint $table) {
        $table->id();
        
        // KOREKSI KRITIS: Gunakan Foreign Key ID yang benar
        $table->foreignId('obat_id') 
              ->nullable()
              ->constrained('obats') // Merujuk ke tabel 'obats'
              ->onUpdate('cascade')
              ->onDelete('restrict');
              
        $table->string('Pasien');
        $table->string('Diagnosa_Penyakit')->nullable();
        $table->string('Tindak_Lanjut')->nullable();
        $table->year('tahun_Periksa')->nullable();
        $table->enum('status', ['sudah diperiksa', 'belum diperiksa'])->default('belum diperiksa');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
  public function down(): void
{
    Schema::dropIfExists('rekam_medis');
}
};
