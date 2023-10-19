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
        Schema::create('forma', function (Blueprint $table) {
            $table->smallInteger('ID_Lote')->index('ID_Lote');
            $table->smallInteger('ID_Paquete')->primary();
            $table->smallInteger('ID_Estado')->index('ID_Estado');
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
        Schema::dropIfExists('forma');
    }
};
