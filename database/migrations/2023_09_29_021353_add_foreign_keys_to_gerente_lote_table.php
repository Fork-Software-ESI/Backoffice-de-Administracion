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
        Schema::table('gerente_lote', function (Blueprint $table) {
            $table->foreign(['ID_Gerente'], 'gerente_lote_ibfk_1')->references(['ID_Gerente'])->on('gerente_almacen');
            $table->foreign(['ID_Lote'], 'gerente_lote_ibfk_2')->references(['ID'])->on('lote');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gerente_lote', function (Blueprint $table) {
            $table->dropForeign('gerente_lote_ibfk_1');
            $table->dropForeign('gerente_lote_ibfk_2');
        });
    }
};
