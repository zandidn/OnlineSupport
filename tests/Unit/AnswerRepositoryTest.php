<?php

declare(strict_types = 1);

namespace Tests\Unit;

use App\Models\Answer;
use App\Repositories\AnswerRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function app;

class AnswerRepositoryTest extends TestCase
{
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function test_question_create_update()
    {
        $answer = Answer::factory()->create();

        $this->assertDatabaseHas('answers', [
            'answer' => $answer->answer,
            'question_id'   => $answer->question_id,
            'user_id'  => $answer->user_id
        ]);

        $newAnswer = "my answer";

        $this->getAnswerRepositoryInstance()->update([
            'answer' => $newAnswer
        ], $answer->id);

        $this->assertDatabaseHas('answers', ['id' => $answer->id, 'answer' => $newAnswer]);
    }

    /**
     * @return \App\Repositories\AnswerRepository
     */
    public function getAnswerRepositoryInstance() : AnswerRepository
    {
        return app()->get(AnswerRepository::class);
    }
}
