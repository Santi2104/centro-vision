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
        Schema::create('queues', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable()->comment('Fk a la tabla pacientes');
            $table->string('profesional_id')->nullable()->comment('Fk a la tabla de profesionales');
            $table->boolean('llamando')->default(0)->comment('Valor para saber si se lo esta llamando para asistir al consultorio');
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
        Schema::dropIfExists('queues');
    }
}
