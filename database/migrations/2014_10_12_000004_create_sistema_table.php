<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSistemaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('sistema', function (Blueprint $table) {
        $table->engine ='InnoDB';
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_unicode_ci';
        $table->bigIncrements('id');
        $table->string('emp', 150)->unique()->comment('Nombre de la empresa');
        $table->string('emp_abrev', 50)->unique()->comment('Nombre de la empresa abreviado');
        $table->string('year_de_ini', 15)->comment('Año en el que se inauguró la empresa');
        $table->string('log_rut', 200)->comment('Ruta de donde se guardo el logo');
        $table->string('log_nom', 200)->comment('Nombre del logo');
        $table->string('img_login_rut', 200)->comment('Ruta de donde se guardó la imagen que se muestra en el login');
        $table->string('img_login_nom', 200)->comment('Nombre de la imagen que se muestra en el login');
        $table->string('def_img_perf_rut', 200)->comment('Ruta de donde se guardó la imagen que se muestra si un usuario no estableció una imagen de perfil');
        $table->string('def_img_perf_nom', 200)->comment('Nombre de la imagen que se muestra si un usuario no estableció una imagen de perfil');
        $table->string('def_img_rut', 200)->comment('Ruta de donde se guardó la imagen que se muestra si no hay una imagen');
        $table->string('def_img_nom', 200)->comment('Nombre de la imagen que se muestra  si no hay una imagen');
        $table->string('img_cons_rut', 200)->comment('Ruta de donde se guardó la imagen que se muestra si un módulo está en desarrollo');
        $table->string('img_cons_nom', 200)->comment('Nombre de la imagen que se muestra si un módulo está en desarrollo');
        $table->unsignedBigInteger('plant_usu_bien')->nullable()->comment('Id de la plantilla por default para el módulo Usuarios (Bienvenida)');
        $table->unsignedBigInteger('plant_cli_bien')->nullable()->comment('Id de la plantilla por default para el módulo Clientes (Bienvenida)');
        $table->unsignedBigInteger('plant_per_camb_pass')->nullable()->comment('Id de la plantilla por default para el módulo Perfil (Cambio de contraseña)');
        $table->unsignedBigInteger('plant_sis_rest_pass')->nullable()->comment('Id de la plantilla por default para el módulo Sistema (Restablecimiento de contraseña)');
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
        Schema::dropIfExists('sistema');
    }
}
