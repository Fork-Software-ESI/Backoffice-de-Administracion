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
        Schema::table('funcionario_forma', function (Blueprint $table) {
            $table->foreign(['ID_Funcionario'], 'funcionario_forma_ibfk_1')->references(['ID'])->on('funcionario_almacen');
            $table->foreign(['ID_Paquete'], 'funcionario_forma_ibfk_2')->references(['ID'])->on('paquete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('funcionario_forma', function (Blueprint $table) {
            $table->dropForeign('funcionario_forma_ibfk_1');
            $table->dropForeign('funcionario_forma_ibfk_2');
        });
    }
};
