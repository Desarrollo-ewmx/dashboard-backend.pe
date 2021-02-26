<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePapeleraDeReciclajeTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('papelera_de_reciclaje', function (Blueprint $table) {
      $table->engine ='InnoDB';
      $table->charset = 'utf8mb4';
      $table->collation = 'utf8mb4_unicode_ci';
      $table->bigIncrements('id');
      $table->unsignedBigInteger('user_id')->comment('Llave foranea');
      $table->foreign('user_id')->references('id')->on('users')->onUpdate('restrict')->onDelete('cascade');
      $table->integer('papelera_id')->unsigned()->comment('ID del modelo');
      $table->string('papelera_type')->comment('Ruta del modelo');
      $table->string('mod', 50)->comment('Nombre del módulo en el que se elimino el registro');
      $table->string('reg', 200)->comment('Información a mostrar en la papelera');
      $table->string('tab', 50)->comment('Nombre de la tabla en la BD');
      $table->string('id_fk', 20)->nullable()->comment('ID de la llave foranea con la que tiene relación');
      $table->timestamp('created_at')->useCurrent();
      $table->timestamp('updated_at')->useCurrent();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('papelera_de_reciclaje');
  }
}
