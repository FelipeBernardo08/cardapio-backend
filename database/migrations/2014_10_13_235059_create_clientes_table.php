<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cpf')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('end_rua')->nullable();
            $table->string('end_numero')->nullable();
            $table->string('end_cidade')->nullable();
            $table->string('end_estado')->nullable();
            $table->string('end_cep')->nullable();
            $table->unsignedBigInteger('fk_user');
            $table->foreign('fk_user')->references('id')->on('users');
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
        Schema::dropIfExists('clientes');
    }
}