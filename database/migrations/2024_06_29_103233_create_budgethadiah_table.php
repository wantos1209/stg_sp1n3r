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
        Schema::create('budgethadiah', function (Blueprint $table) {
            $table->id();
            $table->double('budget')->default(0);
            $table->integer('jenis_event')->default(0);
            $table->string('nama_event', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgethadiah');
    }
};
