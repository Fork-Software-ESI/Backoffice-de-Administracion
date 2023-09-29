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
        Schema::table('estante', function (Blueprint $table) {
            $table->foreign(['ID_Almacen'], 'estante_ibfk_1')->references(['ID'])->on('almacen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estante', function (Blueprint $table) {
            $table->dropForeign('estante_ibfk_1');
        });
    }
};
