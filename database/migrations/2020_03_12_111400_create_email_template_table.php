<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('email_template', function (Blueprint $table) {
        $table->engine ='InnoDB';
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_unicode_ci';
        $table->bigIncrements('id');
        $table->string('mod', 35)->comment('Modulo al que pertenece la plantilla');
        $table->string('name', 100)->unique()->comment('Nombre del correo que asigna el usuario');
        $table->string('subject')->comment('Asunto o sujeto del correo');
        $table->longtext('content')->comment('Contenido del correo');
        $table->string('asig_reg', 75)->comment('Correo del usuario al que se le asigno este registro');
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
        Schema::dropIfExists('email_template');
    }
}
