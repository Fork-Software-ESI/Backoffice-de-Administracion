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
        Schema::table('paquete_estante', function (Blueprint $table) {
            $table->foreign(['ID_Paquete'], 'paquete_estante_ibfk_1')->references(['ID'])->on('paquete');
            $table->foreign(['ID_Estante', 'ID_Almacen'], 'paquete_estante_ibfk_2')->references(['ID', 'ID_Almacen'])->on('estante');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paquete_estante', function (Blueprint $table) {
            $table->dropForeign('paquete_estante_ibfk_1');
            $table->dropForeign('paquete_estante_ibfk_2');
        });
    }
};
