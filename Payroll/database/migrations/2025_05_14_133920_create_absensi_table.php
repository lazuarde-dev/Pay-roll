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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id(); // bigint, PK, AI
            $table->foreignId('karyawan_id')->constrained('karyawan')->onDelete('cascade'); // bigint, NN, FK
            $table->date('tanggal'); // date, NN
            $table->time('jam_masuk')->nullable(); // time, Nullable
            $table->time('jam_pulang')->nullable(); // time, Nullable
            $table->enum('status', ['hadir', 'izin', 'sakit', 'tanpa keterangan']); // enum, NN
            $table->text('keterangan')->nullable(); // text, Nullable
            $table->timestamps(); // created_at, updated_at, Nullable

            $table->unique(['karyawan_id', 'tanggal']); // Constraint
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
