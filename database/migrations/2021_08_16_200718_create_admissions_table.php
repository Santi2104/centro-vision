<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date')->comment('Fecha de ingreso?');
            $table->string('user_id')->nullable()->comment('FK a la tabla usuarios');
            $table->string('OS')->nullable()->comment('Fk a las obras sociales');
            $table->string('profesional')->nullable()->comment('FK a los profesionales');
            $table->string('practica')->nullable()->comment('Fk a la tabla de practicas, si lo hubiese');
            $table->string('importe')->comment('Debe ser integer?');
            $table->string('notes')->nullable()->comment('Comentarios');
            $table->string('id_comprobante')->nullable()->comment('Deberia ser un bigInteger');
            $table->boolean('canceled')->default(false)->comment('Ingreso cancelado?');
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
        Schema::dropIfExists('admissions');
    }
}
