<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->id(); 


            $table->foreignId('user_id')
                  ->constrained('users') // Menghubungkan ke tabel 'users'
                  ->onDelete('cascade'); // Jika user dihapus, data pasien juga terhapus

            // Data Pribadi Pasien
            $table->char('golongan_darah', 3)->nullable(); // CHAR(3)
            $table->double('tinggi_badan')->nullable();
            $table->double('berat_badan')->nullable();
            
            $table->timestamp('tanggal_lahir')->nullable(); 
            
            
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable(); 
            
            $table->text('alamat');
            $table->string('no_hp', 20)->nullable(); // VARCHAR(20)

           
        });
    }

   
    public function down(): void
    {
        
        Schema::table('pasien', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('pasien');
    }
};