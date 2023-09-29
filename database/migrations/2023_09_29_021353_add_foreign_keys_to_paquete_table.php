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
        Schema::table('paquete', function (Blueprint $table) {
            $table->foreign(['ID_Cliente'], 'paquete_ibfk_1')->references(['ID'])->on('cliente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paquete', function (Blueprint $table) {
            $table->dropForeign('paquete_ibfk_1');
        });
    }
};
