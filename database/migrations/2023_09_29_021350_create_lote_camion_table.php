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
        Schema::create('lote_camion', function (Blueprint $table) {
            $table->smallInteger('ID_Camion')->index('ID_Camion');
            $table->smallInteger('ID_Lote')->primary();
            $table->dateTime('Fecha_Hora_Inicio');
            $table->string('Estado', 50);
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
        Schema::dropIfExists('lote_camion');
    }
};
