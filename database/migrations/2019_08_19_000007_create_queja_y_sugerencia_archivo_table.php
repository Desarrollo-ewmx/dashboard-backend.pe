<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuejaYSugerenciaArchivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('queja_y_sugerencia_archivo', function (Blueprint $table) {
        $table->unsignedBigInteger('queja_y_sugerencia_id')->comment('Foreign Key');
        $table->unsignedBigInteger('archivo_id')->comment('Foreign Key');
        $table->foreign('queja_y_sugerencia_id')->references('id')->on('quejas_y_sugerencias')->onUpdate('restrict')->onDelete('cascade');
        $table->foreign('archivo_id')->references('id')->on('archivos')->onUpdate('restrict')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('queja_y_sugerencia_archivo');
    }
}
