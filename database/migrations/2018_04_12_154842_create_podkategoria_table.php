<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePodkategoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('podkategoria', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kategoria_id');
            $table->foreign('kategoria_id')->references('id')->on('kategoria')->onDelete('cascade');
            $table->string('nazwa',50);
            $table->string('opis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('podkategoria');
    }
}
