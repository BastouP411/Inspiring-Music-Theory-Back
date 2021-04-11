<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinigamesQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minigames_quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('chapter_id');
            $table->foreign('chapter_id')
                ->references('id')
                ->on('chapters')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
        Schema::dropIfExists('minigames_quizzes');
    }
}
