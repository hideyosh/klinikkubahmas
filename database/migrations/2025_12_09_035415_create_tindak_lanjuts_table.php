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
    Schema::create('tindak_lanjuts', function (Blueprint $table) {
        $table->id();
        
        // Foreign Key merujuk ke tabel rekam_medis
        $table->foreignId('rekam_medis_id')
              ->constrained('rekam_medis') // Nama tabel rujukan
              ->onDelete('cascade'); // Jika rekam medis dihapus, tindak lanjut ikut terhapus
              
        $table->date('tanggal_lanjut');
        $table->text('deskripsi_tindak_lanjut');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindak_lanjuts');
    }
};
