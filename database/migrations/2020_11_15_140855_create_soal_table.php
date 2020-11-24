<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idGrup');
            $table->boolean('modelSoal')->comment('1 : Pilihan Ganda, 2 : Sebab Akibat, 3 : Benar Salah, 4 : Esai');
            $table->string('media')->nullable();
            $table->text('pertanyaan');
            $table->bigInteger('idPilihan')->nullable();
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
        Schema::dropIfExists('soal');
    }
}
