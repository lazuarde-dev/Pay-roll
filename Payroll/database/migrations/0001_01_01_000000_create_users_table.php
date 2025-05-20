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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // bigint, PK, AI
            $table->string('name'); // varchar(255), NN
            $table->string('email')->unique(); // varchar(255), NN, Unique
            $table->string('password'); // varchar(255), NN
            $table->enum('role', ['admin', 'karyawan']); // enum, NN
            $table->rememberToken(); // varchar(100), Nullable
            $table->timestamps(); // created_at, updated_at, Nullable
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
