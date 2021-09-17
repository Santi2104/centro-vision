<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agenda_id')->constrained();//Faltan campos, como el DNI, telefono, etc...
            $table->foreignId('patient_id')->constrained();
            $table->string('orden')->unique();
            $table->text('observaciones')->nullable();
            $table->foreignId('practice_id')->constrained();
            $table->boolean('cancelado')->default(0);
            $table->boolean('cumplido')->default(0);
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
        Schema::dropIfExists('turnos');
    }
}
