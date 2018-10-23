<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKontoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konto', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rola_id');
            $table->foreign('rola_id')->references('id')->on('rola')->onDelete('cascade');
            $table->string('imie',50)->unique();
            $table->string('nazwisko',50);
            $table->string('email',50);
            $table->string('login',50);
            $table->string('haslo',300);
            $table->date('created_at');
            $table->date('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konto');
    }
}
