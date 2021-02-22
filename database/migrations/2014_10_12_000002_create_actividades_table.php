<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('actividades', function (Blueprint $table) {
        $table->engine ='InnoDB';
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_unicode_ci';
        $table->bigIncrements('id');
        $table->unsignedBigInteger('user_id')->comment('Llave foranea');
        $table->foreign('user_id')->references('id')->on('users')->onUpdate('restrict')->onDelete('cascade');
        $table->integer('actividad_id')->unsigned()->comment('ID del modelo');
        $table->string('actividad_type')->comment('Ruta del modelo');
        $table->string('mod', 100)->comment('Módulo donde se hizo la modificación');
        $table->string('rut', 200)->comment('Ruta donde se hizo la modificación');
        $table->string('perm', 200)->comment('Permisos para ver el registro');
        $table->string('inpu', 200)->comment('Nombre del input que se modifico');
        $table->longtext('ant')->nullable()->comment('Valor del campo antes de ser modificado');
        $table->longtext('nuev')->nullable()->comment('Nuevo valor del campo después de ser modificado');
        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->useCurrent();
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
        Schema::dropIfExists('actividades');
    }
}
