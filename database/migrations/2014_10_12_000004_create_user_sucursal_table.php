<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSucursalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('user_sucursal', function (Blueprint $table) {
        $table->engine ='InnoDB';
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_unicode_ci';
        $table->unsignedBigInteger('user_id')->comment('Foreign Key');
        $table->unsignedBigInteger('sucursal_id')->comment('Foreign Key');
        $table->foreign('user_id')->references('id')->on('users')->onUpdate('restrict')->onDelete('cascade');
        $table->foreign('sucursal_id')->references('id')->on('sucursales')->onUpdate('restrict')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_sucursal');
    }
}
