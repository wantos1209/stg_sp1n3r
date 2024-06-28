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
        Schema::create('spinner_generatevoucher', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_voucher');
            $table->date('tgl_exp');
            $table->integer('jumlah');
            $table->timestamps();
            $table->string('userid')->nullable();
            $table->string('bo')->nullable();
            $table->text('keterangan')->nullable();
            $table->tinyInteger('tipe_generate')->default(0);
            $table->double('total_budget')->default(0);
            $table->string('presentase')->nullable();
            $table->string('target_bo')->nullable();
            $table->tinyInteger('isdemo')->default(0);
            $table->string('agentid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spinner_generatevoucher');
    }
};
