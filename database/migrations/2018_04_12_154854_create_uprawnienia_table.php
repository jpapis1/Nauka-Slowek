<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUprawnieniaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uprawnienia', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('konto_id');
            $table->unsignedInteger('podkategoria_id');
            $table->foreign('konto_id')->references('id')->on('konto')->onDelete('cascade');
            $table->foreign('podkategoria_id')->references('id')->on('podkategoria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uprawnienia');
    }
}
