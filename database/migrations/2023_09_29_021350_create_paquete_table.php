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
        Schema::create('paquete', function (Blueprint $table) {
            $table->smallInteger('ID', true);
            $table->smallInteger('ID_Cliente')->index('ID_Cliente');
            $table->string('Descripcion', 50)->nullable();
            $table->smallInteger('Peso_Kg');
            $table->string('Estado', 50);
            $table->string('Destino');
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
        Schema::dropIfExists('paquete');
    }
};
