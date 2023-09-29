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
        Schema::table('persona_telefono', function (Blueprint $table) {
            $table->foreign(['ID'], 'persona_telefono_ibfk_1')->references(['ID'])->on('persona');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('persona_telefono', function (Blueprint $table) {
            $table->dropForeign('persona_telefono_ibfk_1');
        });
    }
};
