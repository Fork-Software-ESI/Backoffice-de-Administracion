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
        Schema::table('lote_camion', function (Blueprint $table) {
            $table->foreign(['ID_Camion'], 'lote_camion_ibfk_1')->references(['ID'])->on('camion');
            $table->foreign(['ID_Lote'], 'lote_camion_ibfk_2')->references(['ID'])->on('lote');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lote_camion', function (Blueprint $table) {
            $table->dropForeign('lote_camion_ibfk_1');
            $table->dropForeign('lote_camion_ibfk_2');
        });
    }
};
