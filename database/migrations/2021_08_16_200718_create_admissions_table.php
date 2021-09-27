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
            $table->foreignId('user_id')->constrained();  
            $table->foreignId('o_s_id')->constrained();
            $table->foreignId('professional_id')->constrained();
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('practice_id')->constrained();
            $table->float('importe',6,2)->comment('Debe ser integer?');
            $table->string('notes')->nullable()->comment('Comentarios');
            $table->bigInteger('nro_comprobante')->nullable()->comment('Identificacion del comprobante de cada admision');
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
