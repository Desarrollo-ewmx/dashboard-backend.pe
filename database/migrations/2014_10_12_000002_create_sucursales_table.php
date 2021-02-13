<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSucursalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('sucursales', function (Blueprint $table) {
        $table->engine ='InnoDB';
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_unicode_ci';
        $table->bigIncrements('id');
        $table->string('log_rut', 200)->nullable()->comment('Ruta de donde se guardo el logo');
        $table->string('log_nom', 200)->nullable()->comment('Nombre del logo');
        $table->string('suc', 50)->unique()->comment('Nombre de la sucursal');
        $table->string('direc', 200)->nullable()->comment('Dirección');
        $table->string('ser_cot', 150)->nullable()->comment('Value de la serie por default para el módulo Cotizaciones');
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
        Schema::dropIfExists('sucursales');
    }
}
