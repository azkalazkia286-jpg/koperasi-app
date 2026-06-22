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
    Schema::create('pinjamans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('anggota_id')->constrained('anggotas')->cascadeOnDelete();
        $table->string('nomor_pinjaman')->unique();
        $table->date('tanggal_pengajuan');
        $table->decimal('jumlah_pinjaman', 15, 2);
        $table->integer('tenor'); // Dalam bulan
        $table->decimal('bunga', 5, 2); // Persentase
        $table->decimal('total_pinjaman', 15, 2);
        $table->enum('status', ['Menunggu', 'Disetujui', 'Ditolak', 'Lunas'])->default('Menunggu');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjamen');
    }
};
