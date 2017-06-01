<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoletoOcorrenciasTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql_boletos')->create('boleto_ocorrencias', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_boleto')->unsigned();
            $table->string('situacao');
            $table->date('data');
            $table->string('descricao');
            $table->text('motivos');
            $table->text('info')->nullable();
            $table->timestamps();

            $table->foreign('id_boleto')->references('id')->on('boleto_solicitado');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('boleto_ocorrencias');
	}

}
