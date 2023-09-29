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
        Schema::table('gerente_almacen', function (Blueprint $table) {
            $table->foreign(['ID_Gerente'], 'gerente_almacen_ibfk_1')->references(['ID'])->on('persona');
            $table->foreign(['ID_Almacen'], 'gerente_almacen_ibfk_2')->references(['ID'])->on('almacen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gerente_almacen', function (Blueprint $table) {
            $table->dropForeign('gerente_almacen_ibfk_1');
            $table->dropForeign('gerente_almacen_ibfk_2');
        });
    }
};
