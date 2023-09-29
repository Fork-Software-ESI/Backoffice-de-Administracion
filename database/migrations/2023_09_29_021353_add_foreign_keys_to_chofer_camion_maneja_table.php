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
        Schema::table('chofer_camion_maneja', function (Blueprint $table) {
            $table->foreign(['ID_Chofer', 'ID_Camion'], 'chofer_camion_maneja_ibfk_1')->references(['ID_Chofer', 'ID_Camion'])->on('chofer_camion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chofer_camion_maneja', function (Blueprint $table) {
            $table->dropForeign('chofer_camion_maneja_ibfk_1');
        });
    }
};
