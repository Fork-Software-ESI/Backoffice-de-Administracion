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
        Schema::table('persona_usuario', function (Blueprint $table) {
            $table->foreign(['ID_Persona'], 'persona_usuario_ibfk_1')->references(['ID'])->on('persona');
            $table->foreign(['ID_Usuario'], 'persona_usuario_ibfk_2')->references(['ID'])->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('persona_usuario', function (Blueprint $table) {
            $table->dropForeign('persona_usuario_ibfk_1');
            $table->dropForeign('persona_usuario_ibfk_2');
        });
    }
};
