<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchievementMGQsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievement_m_g_q_s', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedBigInteger('MGQ_id');
            $table->foreign('MGQ_id')
                ->references('id')
                ->on('minigames_quizzes')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->integer('level')->nullable();
            $table->float('score');
            $table->boolean('evaluated');
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
        Schema::dropIfExists('achievement_m_g_q_s');
    }
}
