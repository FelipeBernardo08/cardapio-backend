<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_carrinho');
            $table->unsignedBigInteger('fk_cliente');
            $table->float('valor_total');
            $table->string('forma_pagamento');
            $table->foreign('fk_cliente')->references('id')->on('clientes');
            $table->foreign('fk_carrinho')->references('id')->on('carrinhos');
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
        Schema::dropIfExists('vendas');
    }
}
