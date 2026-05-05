<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('jenis_pembayaran'); // biaya_pendaftaran, spp, dll
            $table->decimal('jumlah', 15, 2);
            $table->string('bukti_path')->nullable();
            $table->enum('status', ['pending', 'valid', 'ditolak', 'belum_bayar'])->default('belum_bayar');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
