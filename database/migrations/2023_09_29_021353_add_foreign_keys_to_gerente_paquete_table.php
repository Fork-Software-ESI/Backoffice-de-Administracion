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
        Schema::table('gerente_paquete', function (Blueprint $table) {
            $table->foreign(['ID_Gerente'], 'gerente_paquete_ibfk_1')->references(['ID_Gerente'])->on('gerente_almacen');
            $table->foreign(['ID_Paquete'], 'gerente_paquete_ibfk_2')->references(['ID'])->on('paquete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gerente_paquete', function (Blueprint $table) {
            $table->dropForeign('gerente_paquete_ibfk_1');
            $table->dropForeign('gerente_paquete_ibfk_2');
        });
    }
};
