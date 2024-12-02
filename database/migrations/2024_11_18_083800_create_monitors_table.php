<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jaringan_id')->constrained('jaringans')->onDelete('cascade');
            $table->string('kondisi');
            $table->integer('upload');
            $table->integer('download');
            $table->foreignId('petugas_id')->constrained('users')->onDelete('cascade');
            $table->string('status')->default('Belum Disetujui');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monitors');
    }
};
