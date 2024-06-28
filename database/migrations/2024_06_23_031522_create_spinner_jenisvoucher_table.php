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
        Schema::create('spinner_jenisvoucher', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
            $table->integer('index')->nullable();
            $table->double('saldo_point')->nullable();
            $table->string('hadiah')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spinner_jenisvoucher');
    }
};
