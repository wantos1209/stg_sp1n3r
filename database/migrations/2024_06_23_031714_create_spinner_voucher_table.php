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
        Schema::create('spinner_voucher', function (Blueprint $table) {
            $table->id();
            $table->string('userid');
            $table->string('jenis_voucher');
            $table->string('kode_voucher')->nullable();
            $table->integer('balance_kredit')->nullable();
            $table->timestamps();
            $table->string('username')->nullable();
            $table->string('bo')->nullable();
            $table->double('saldo')->nullable();
            $table->string('userklaim')->nullable();
            $table->timestamp('tgl_klaim')->nullable();
            $table->date('tgl_exp')->nullable();
            $table->unsignedBigInteger('genvoucherid')->nullable();
            $table->tinyInteger('status_transfer')->nullable();
            $table->integer('urutan')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spinner_voucher');
    }
};
