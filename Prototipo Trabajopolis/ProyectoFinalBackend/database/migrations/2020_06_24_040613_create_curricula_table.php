<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curricula', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users') ->onDelete('cascade');
            $table->foreignId('ciudad_id')->references('id')->on('ciudads') ->onDelete('cascade');
            $table->string('trabajos');
            $table->string('logros');
            $table->string('profesion');
            $table->string('telefono');
            $table->date('fechadenacimiento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curricula');
    }
}
