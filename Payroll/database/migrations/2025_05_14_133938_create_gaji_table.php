<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGajiTable extends Migration
{
    public function up(): void
    {
        Schema::create('gaji', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawan')->onDelete('cascade');
            $table->tinyInteger('bulan');
            $table->year('tahun');
            $table->integer('total_hadir');
            $table->integer('total_izin');
            $table->integer('total_sakit');
            $table->integer('total_tanpa_keterangan');
            $table->decimal('gaji_pokok', 10, 2);
            $table->decimal('potongan', 10, 2);
            $table->decimal('gaji_bersih', 10, 2);
            $table->text('keterangan_gaji')->nullable();
            $table->date('tanggal_pembayaran')->nullable();
            $table->timestamps();

            $table->unique(['karyawan_id', 'bulan', 'tahun']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gaji');
    }
}
