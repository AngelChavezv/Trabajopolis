<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculum_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')
            ->on('users') ->onDelete('cascade');
             $table->foreignId('curricula_id')->references('id')
            ->on('curricula') ->onDelete('cascade');

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
        Schema::dropIfExists('curriculum_users');
    }
}
