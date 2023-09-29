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
        Schema::table('chofer_tipo_libreta', function (Blueprint $table) {
            $table->foreign(['ID'], 'chofer_tipo_libreta_ibfk_1')->references(['ID'])->on('chofer');
            $table->foreign(['Tipo'], 'chofer_tipo_libreta_ibfk_2')->references(['Tipo'])->on('tipo_libreta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chofer_tipo_libreta', function (Blueprint $table) {
            $table->dropForeign('chofer_tipo_libreta_ibfk_1');
            $table->dropForeign('chofer_tipo_libreta_ibfk_2');
        });
    }
};
