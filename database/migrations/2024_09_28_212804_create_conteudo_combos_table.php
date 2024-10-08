<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConteudoCombosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conteudo_combos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_produto');
            $table->unsignedBigInteger('fk_combo');

            $table->foreign('fk_produto')->references('id')->on('produtos');
            $table->foreign('fk_combo')->references('id')->on('combos');
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
        Schema::dropIfExists('conteudo_combos');
    }
}
