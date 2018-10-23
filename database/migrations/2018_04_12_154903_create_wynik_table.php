<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWynikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wynik', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('konto_id');
            $table->unsignedInteger('zestaw_id');
            $table->foreign('konto_id')->references('id')->on('konto')->onDelete('cascade');
            $table->foreign('zestaw_id')->references('id')->on('zestaw')->onDelete('cascade');
            $table->date('data_wyniku');
            $table->integer('wynik');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wynik');
    }
}
