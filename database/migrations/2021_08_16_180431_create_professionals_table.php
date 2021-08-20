<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professionals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->integer('code')->default(0)->comment('Habria que preguntar si es necesario');
            $table->string('matricula_prov')->nullable();
            $table->string('matricula_nac')->nullable();
            $table->string('especialidad')->nullable()->comment('Deberia ser FK');
            $table->boolean('suspended')->default(false);
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
        Schema::dropIfExists('professionals');
    }
}
