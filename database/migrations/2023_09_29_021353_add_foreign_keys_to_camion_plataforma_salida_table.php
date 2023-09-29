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
        Schema::table('camion_plataforma_salida', function (Blueprint $table) {
            $table->foreign(['ID_Camion', 'ID_Almacen', 'Numero_Plataforma'], 'camion_plataforma_salida_ibfk_1')->references(['ID_Camion', 'ID_Almacen', 'Numero_Plataforma'])->on('camion_plataforma');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('camion_plataforma_salida', function (Blueprint $table) {
            $table->dropForeign('camion_plataforma_salida_ibfk_1');
        });
    }
};
