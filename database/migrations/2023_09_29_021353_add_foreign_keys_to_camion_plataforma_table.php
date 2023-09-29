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
        Schema::table('camion_plataforma', function (Blueprint $table) {
            $table->foreign(['ID_Camion'], 'camion_plataforma_ibfk_1')->references(['ID'])->on('camion');
            $table->foreign(['ID_Almacen', 'Numero_Plataforma'], 'camion_plataforma_ibfk_2')->references(['ID_Almacen', 'Numero'])->on('plataforma');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('camion_plataforma', function (Blueprint $table) {
            $table->dropForeign('camion_plataforma_ibfk_1');
            $table->dropForeign('camion_plataforma_ibfk_2');
        });
    }
};
