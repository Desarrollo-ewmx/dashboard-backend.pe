<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('users', function (Blueprint $table) {
        $table->engine ='InnoDB';
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_unicode_ci';
        $table->bigIncrements('id');
        $table->string('img_rut', 200)->nullable()->comment('Ruta de donde se guardo la imagen');
        $table->string('img_nom', 200)->nullable()->comment('Nombre de la imagen');
        $table->string('menuroles', 200)->comment('Tipo de acceso que tiene el usuario');
        $table->unsignedBigInteger('id_suc_act')->comment('Sucursal activa');
        $table->string('reg_tab_acces', 5)->comment('Define si vera todos los registros de la tabla o solo los que se le asignaron o los que usuario registro');
        $table->string('notif', 5)->comment('Define si recibe o no notificaciones');
        $table->string('name', 40)->comment('Nombre');
        $table->string('apell', 40)->comment('Apellido(s)');
        $table->string('email_registro',75)->unique()->comment('Correo con el que se registró al sistema');
        $table->string('email',75)->unique()->comment('Correo con el que tendrá acceso al sistema');
        $table->string('email_secund',75)->nullable()->comment('Correo secundario');
        $table->timestamp('email_verified_at')->nullable()->comment('Fecha en la que se verifico el correo');
        $table->dateTime('login')->nullable()->comment('Fecha en la que inicio sesión');
        $table->dateTime('last_login')->nullable()->comment('Fecha de la ultima vez que inicio sesión');
        $table->string('tel_fij', 14)->nullable()->comment('Teléfono fijo');
        $table->string('ext', 15)->nullable()->comment('Extensión');
        $table->string('tel_mov', 14)->comment('Teléfono móvil');
        $table->string('emp', 120)->nullable()->comment('Nombre completo de la empresa a la que pertenece');
        $table->string('password');
        $table->string('api_token', 80)->unique()->nullable()->default(null);
        $table->rememberToken();
        $table->text('obs')->nullable()->comment('Observaciones');
        $table->string('lang', 4)->default('es')->comment('Idioma en el que se mostrara el sistema');
        $table->string('sidebarShow', 15)->default('responsive')->comment('Define si la barra del menu izquierdo esta oculta o no');
        $table->boolean('darkMode')->default(false)->comment('Define si es tema obscuro o claro');
        $table->string('asig_reg', 75)->comment('Correo del usuario al qu se le asigno este registro');
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
        Schema::dropIfExists('users');
    }
}
