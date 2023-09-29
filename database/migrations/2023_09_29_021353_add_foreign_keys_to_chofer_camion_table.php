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
        Schema::table('chofer_camion', function (Blueprint $table) {
            $table->foreign(['ID_Camion'], 'chofer_camion_ibfk_1')->references(['ID'])->on('camion');
            $table->foreign(['ID_Chofer'], 'chofer_camion_ibfk_2')->references(['ID'])->on('chofer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chofer_camion', function (Blueprint $table) {
            $table->dropForeign('chofer_camion_ibfk_1');
            $table->dropForeign('chofer_camion_ibfk_2');
        });
    }
};
