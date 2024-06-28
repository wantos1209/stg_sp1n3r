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
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->string('website');
            $table->string('androidid');
            $table->string('kode');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('ip')->nullable();
            $table->tinyInteger('isklaim')->default(0);
            $table->string('username')->nullable();
            $table->double('hadiah')->default(0);
            $table->integer('status')->default(0);
            $table->string('keterangan')->nullable();
            $table->integer('prize_id')->default(0);
            $table->string('approve_by')->nullable();
            $table->string('url_spinner')->nullable();
            $table->integer('vote')->default(0);
            $table->integer('jenis_event')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event');
    }
};
