<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chofer_camion_maneja', function (Blueprint $table) {
            $table->smallInteger('ID_Chofer');
            $table->smallInteger('ID_Camion');
            $table->dateTime('Fecha_Hora_Fin');

            $table->primary(['ID_Chofer', 'ID_Camion']);
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
        Schema::dropIfExists('chofer_camion_maneja');
    }
};
