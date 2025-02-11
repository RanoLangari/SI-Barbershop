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
        Schema::create('refund', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_reservasi')->constrained('reservasi')->onDelete('cascade');
            $table->foreignId('id_pembayaran')->constrained('pembayaran')->onDelete('cascade');
            $table->text('alasan');
            $table->enum('status', ['pending', 'success', 'failed']);
            $table->text('bukti')->nullable();
            $table->string('merchant');
            $table->string('address_refund');
            $table->string('address_name');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund');
    }
};
