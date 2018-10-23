<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZestawTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {Schema::create('zestaw', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('konto_id');
            $table->unsignedInteger('jezyk1_id');
            $table->unsignedInteger('jezyk2_id');
            $table->unsignedInteger('podkategoria_id');

            $table->foreign('konto_id')->references('id')->on('konto')->onDelete('cascade');
            $table->foreign('jezyk1_id')->references('id')->on('jezyk')->onDelete('cascade');
            $table->foreign('jezyk2_id')->references('id')->on('jezyk')->onDelete('cascade');
            $table->foreign('podkategoria_id')->references('id')->on('podkategoria')->onDelete('cascade');
            $table->string('nazwa',200);
            $table->string('zestaw');
            $table->integer('ilosc_slowek');
            $table->date('data_edycji');
            $table->boolean('private');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zestaw');
    }
}
