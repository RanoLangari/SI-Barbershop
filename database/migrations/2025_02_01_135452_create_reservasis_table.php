

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
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_layanan')->onDelete('cascade');
            $table->foreignId('id_layanan')->constrained('layanan')->onDelete('cascade');
            $table->foreignId('id_barberman')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_jadwal')->constrained('jadwal')->onDelete('cascade');
            $table->foreignId('id_pembayaran')->constrained('pembayaran')->onDelete('cascade');
            $table->dateTime('tanggal_reservasi');
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled']);
            $table->timestamps();

            // Add indexes
            $table->index('tanggal_reservasi');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};
