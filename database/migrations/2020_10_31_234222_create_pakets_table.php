<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idKelas');
            $table->string('nama');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->time('waktu_awal', 0);
            $table->time('waktu_akhir', 0);
            $table->smallInteger('durasi')->unsigned();
            $table->text('deskripsi')->nullable();
            $table->integer('bobot_benar');
            $table->integer('bobot_salah');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('paket');
    }
}
