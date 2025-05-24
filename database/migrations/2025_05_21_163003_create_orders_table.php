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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_layanan')->onDelete('cascade');
            $table->foreignId('id_layanan')->constrained('layanan')->onDelete('cascade');
            $table->foreignId('id_barberman')->constrained('users')->onDelete('cascade');
            $table->string('nama_pemesan');
             $table->string('metode_pembayaran');
            $table->dateTime('tanggal');
            $table->string('jam');
        


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
