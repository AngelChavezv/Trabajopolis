<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaEmpleosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_empleos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleo_id')->references('id')
                ->on('empleos') ->onDelete('cascade');
            $table->foreignId('categoria_id')->references('id')
                ->on('categorias') ->onDelete('cascade');
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
        Schema::dropIfExists('categoria_empleos');
    }
}
