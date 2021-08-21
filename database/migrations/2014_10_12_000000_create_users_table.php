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
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('dni')->unique();
            $table->string('dni_type')->nullable();
            $table->string('name');
            $table->string('lastname');
            $table->string('date')->nullable()->comment('Fecha de nacimiento');
            $table->string('gender')->nullable()->comment('Sexo de la persona');
            $table->string('address')->nullable()->comment('Domicilio');
            $table->string('addr_num')->nullable()->comment('numero de domicilio');
            $table->string('addr_piso')->nullable()->comment('Numero de piso');
            $table->string('addr_dpto')->nullable()->comment('Direccion del departamento');
            $table->string('location')->nullable()->comment('Localidad');
            $table->string('cod_pos')->nullable()->comment('codigo postal');
            $table->string('tel_par')->nullable()->comment('telefono particular');
            $table->string('tel_lab')->nullable()->comment('telefono laboral');
            $table->string('cel')->nullable()->comment('celular');
            $table->string('nacionalidad')->nullable()->comment('Deberia ser clave foranea');
            $table->string('provincia')->nullable()->comment('Deberia ser clave foranea');
            $table->string('email')->unique();
            $table->string('cuit')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('role')->default(1);
            $table->rememberToken();
            $table->timestamps();
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
