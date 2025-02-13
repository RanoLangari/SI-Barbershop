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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('transaksi_id');
            $table->enum('status', ['pending', 'completed', 'cancelled']);
            $table->decimal('jumlah', 10, 2);
            $table->string('metode_pembayaran');
            $table->dateTime('tanggal_pembayaran');
            $table->timestamps();

            // Add indexes
            $table->index('transaksi_id');
            $table->index('status');
            $table->index('tanggal_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
