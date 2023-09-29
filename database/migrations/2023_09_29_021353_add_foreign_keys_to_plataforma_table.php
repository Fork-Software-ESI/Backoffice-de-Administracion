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
        Schema::table('plataforma', function (Blueprint $table) {
            $table->foreign(['ID_Almacen'], 'plataforma_ibfk_1')->references(['ID'])->on('almacen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plataforma', function (Blueprint $table) {
            $table->dropForeign('plataforma_ibfk_1');
        });
    }
};
