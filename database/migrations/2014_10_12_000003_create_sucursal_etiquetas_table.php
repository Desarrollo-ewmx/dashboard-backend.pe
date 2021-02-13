<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSucursalEtiquetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('sucursal_etiquetas', function (Blueprint $table) {
        $table->engine ='InnoDB';
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_unicode_ci';
        $table->bigIncrements('id');
        $table->string('tip', 150)->comment('Tipo de etiqueta');
        $table->string('value', 150)->nullable()->comment('Valor que se guardara en la BD');
        $table->string('text', 150)->comment('Texto que se le mostrara al usuario');
        $table->string('url', 200)->nullable()->comment('URL');
        $table->unsignedBigInteger('sucursal_id')->comment('Foreign Key');
        $table->foreign('sucursal_id')->references('id')->on('sucursales')->onUpdate('restrict')->onDelete('cascade');
        $table->string('created_at_reg', 75)->comment('Correo del usuario que realizo el registro');
        $table->string('updated_at_reg', 75)->nullable()->comment('Correo del usuario que realizo la última modificación');
        $table->timestamps();
        $table->softDeletes();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sucursal_etiquetas');
    }
}
