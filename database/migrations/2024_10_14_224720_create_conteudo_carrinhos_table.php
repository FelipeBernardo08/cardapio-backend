<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConteudoCarrinhosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conteudo_carrinhos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_produto');
            $table->unsignedBigInteger('fk_carrinho');
            $table->unsignedBigInteger('fk_cliente');
            $table->float('valor');
            $table->foreign('fk_produto')->references('id')->on('produtos');
            $table->foreign('fk_carrinho')->references('id')->on('carrinhos');
            $table->foreign('fk_cliente')->references('id')->on('clientes');
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
        Schema::dropIfExists('conteudo_carrinhos');
    }
}
