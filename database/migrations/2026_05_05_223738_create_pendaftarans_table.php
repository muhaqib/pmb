<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('no_pendaftaran')->unique();
            $table->string('prodi');
            $table->string('gelombang');
            $table->boolean('is_profile_complete')->default(false);
            $table->boolean('is_document_uploaded')->default(false);
            $table->boolean('is_payment_uploaded')->default(false);
            $table->enum('status_kelulusan', ['pending', 'lulus', 'tidak_lulus'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
