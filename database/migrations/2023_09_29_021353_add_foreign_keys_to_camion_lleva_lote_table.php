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
        Schema::table('camion_lleva_lote', function (Blueprint $table) {
            $table->foreign(['ID_Lote'], 'camion_lleva_lote_ibfk_1')->references(['ID_Lote'])->on('lote_camion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('camion_lleva_lote', function (Blueprint $table) {
            $table->dropForeign('camion_lleva_lote_ibfk_1');
        });
    }
};
