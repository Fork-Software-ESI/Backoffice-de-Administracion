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
        Schema::create('persona_telefono', function (Blueprint $table) {
            $table->increments('ID');
            $table->smallInteger('ID_Persona');
            $table->string('Telefono');
            $table->timestamps();
            $table->unique(['ID_Persona', 'Telefono']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('persona_telefono');
    }
};
