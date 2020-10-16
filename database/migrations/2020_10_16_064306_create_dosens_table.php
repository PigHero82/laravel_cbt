<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->char('nidn', 10);
            $table->string('nama');
            $table->boolean('jeniskelamin');
            $table->string('email');
            $table->char('ktp', 16);
            $table->char('hp', 13);
            $table->char('telepon', 12)->nullable();
            $table->text('alamat');
            $table->text('alamatasal');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('dosens');
    }
}
