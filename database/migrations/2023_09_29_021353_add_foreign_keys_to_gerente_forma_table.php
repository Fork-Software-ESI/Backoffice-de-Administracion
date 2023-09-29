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
        Schema::table('gerente_forma', function (Blueprint $table) {
            $table->foreign(['ID_Gerente'], 'gerente_forma_ibfk_1')->references(['ID_Gerente'])->on('gerente_almacen');
            $table->foreign(['ID_Paquete'], 'gerente_forma_ibfk_2')->references(['ID_Paquete'])->on('forma');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gerente_forma', function (Blueprint $table) {
            $table->dropForeign('gerente_forma_ibfk_1');
            $table->dropForeign('gerente_forma_ibfk_2');
        });
    }
};
