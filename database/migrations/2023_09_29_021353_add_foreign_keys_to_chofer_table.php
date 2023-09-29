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
        Schema::table('chofer', function (Blueprint $table) {
            $table->foreign(['ID'], 'chofer_ibfk_1')->references(['ID'])->on('persona');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chofer', function (Blueprint $table) {
            $table->dropForeign('chofer_ibfk_1');
        });
    }
};
