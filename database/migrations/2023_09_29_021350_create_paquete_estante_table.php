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
        Schema::create('paquete_estante', function (Blueprint $table) {
            $table->smallInteger('ID_Paquete')->primary();
            $table->smallInteger('ID_Estante');
            $table->smallInteger('ID_Almacen');

            $table->index(['ID_Estante', 'ID_Almacen'], 'ID_Estante');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paquete_estante');
    }
};
