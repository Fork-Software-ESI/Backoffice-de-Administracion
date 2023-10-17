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
        Schema::table('forma', function (Blueprint $table) {
            $table->foreign(['ID_Lote'], 'forma_ibfk_1')->references(['ID'])->on('lote');
            $table->foreign(['ID_Paquete'], 'forma_ibfk_2')->references(['ID'])->on('paquete');
            $table->foreign(['ID_Estado'], 'forma_ibfk_3')->references(['ID'])->on('estadof');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forma', function (Blueprint $table) {
            $table->dropForeign('forma_ibfk_1');
            $table->dropForeign('forma_ibfk_2');
            $table->dropForeign('forma_ibfk_3');
        });
    }
};
