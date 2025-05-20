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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id(); // bigint, PK, AI
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // bigint, NN, FK
            $table->string('nik', 20)->unique()->nullable(); // varchar(20), Unique, Nullable
            $table->text('alamat')->nullable(); // text, Nullable
            $table->string('no_telepon', 15)->nullable(); // varchar(15), Nullable
            $table->string('posisi', 100); // varchar(100), NN
            $table->date('tanggal_masuk'); // date, NN
            $table->decimal('gaji_pokok', 10, 2); // decimal(10,2), NN
            $table->timestamps(); // created_at, updated_at, Nullable
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
