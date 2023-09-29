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
        Schema::create('camion_plataforma', function (Blueprint $table) {
            $table->smallInteger('ID_Camion');
            $table->smallInteger('ID_Almacen');
            $table->smallInteger('Numero_Plataforma');
            $table->dateTime('Fecha_Hora_Llegada');
            $table->index(['ID_Almacen', 'Numero_Plataforma'], 'ID_Almacen');
            $table->primary(['ID_Camion', 'ID_Almacen', 'Numero_Plataforma']);
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
        Schema::dropIfExists('camion_plataforma');
    }
};
