<?php

declare(strict_types = 1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateQuestionsTable.
 */
class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question', 500);
            $table->enum('status', ['Not Answered', 'Answered', 'In Progress', 'SPAM'])->default('Not Answered');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id', 'fk_user_questions')
                ->references('id')
                ->on('users')
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
        if (Schema::hasColumn('questions', 'user_id')) {
            Schema::table('questions', function (Blueprint $table) {
                $table->dropForeign('fk_user_questions');
            });
        }
        Schema::drop('questions');
    }
}
