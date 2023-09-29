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
        Schema::table('funcionario_paquete_estante', function (Blueprint $table) {
            $table->foreign(['ID_Funcionario'], 'funcionario_paquete_estante_ibfk_1')->references(['ID'])->on('funcionario_almacen');
            $table->foreign(['ID_Paquete'], 'funcionario_paquete_estante_ibfk_2')->references(['ID_Paquete'])->on('paquete_estante');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('funcionario_paquete_estante', function (Blueprint $table) {
            $table->dropForeign('funcionario_paquete_estante_ibfk_1');
            $table->dropForeign('funcionario_paquete_estante_ibfk_2');
        });
    }
};
