<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colas', function (Blueprint $table) {
            $table->id();
            //$table->string('user_id')->nullable()->comment('Fk a la tabla pacientes');
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('professional_id')->constrained();
            //$table->string('profesional_id')->nullable()->comment('Fk a la tabla de profesionales');
            $table->time('alta')->comment('Hora de alta de la consulta');//Cambiar el tipo de dato
            $table->boolean('llamando')->default(0)->comment('Valor para saber si se lo esta llamando para asistir al consultorio');
            $table->boolean('atendido')->default(0)->comment('Para saber si el registro actual cumplio con el turno');
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
        Schema::dropIfExists('colas');
    }
}
