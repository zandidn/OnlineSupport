<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('user_id');
            $table->string('answer', 500);
            $table->timestamps();

            $table->foreign('user_id', 'fk_user_answers')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('question_id', 'fk_answer_questions')
                ->references('id')
                ->on('questions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('answers', 'user_id')) {
            Schema::table('answers', function (Blueprint $table) {
                $table->dropForeign('fk_user_answers');
            });
        }
        if (Schema::hasColumn('answers', 'question_id')) {
            Schema::table('questions', function (Blueprint $table) {
                $table->dropForeign('fk_answer_questions');
            });
        }
        Schema::dropIfExists('answers');
    }
}
