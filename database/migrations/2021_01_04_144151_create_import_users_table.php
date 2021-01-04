<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_users', function (Blueprint $table) {
            $table->id();
            $table->char('no_induk', 12);
            $table->string('nama');
            $table->boolean('jenis_kelamin')->default(1);
            $table->string('email')->nullable();
            $table->char('hp', 13)->nullable();
            $table->text('alamat')->nullable();
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
        Schema::dropIfExists('import_users');
    }
}
