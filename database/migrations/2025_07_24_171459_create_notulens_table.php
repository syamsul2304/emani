<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * Jalankan migrasi tabel notulens.
     */
    public function up()
{
    Schema::create('notulens', function (Blueprint $table) {
        $table->id();
        $table->string('judul_rapat');
        $table->date('tanggal_rapat');
        $table->time('waktu_mulai');
        $table->time('waktu_selesai');
        $table->string('tempat');
        $table->string('pembicara');
        $table->text('isi_notulen');
        $table->timestamps();
    });
}


    /**
     * Hapus tabel jika rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('notulens');
    }
};
