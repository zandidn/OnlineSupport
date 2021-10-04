<?php

declare(strict_types = 1);

namespace Tests\Unit;

use App\Models\Question;
use App\Repositories\QuestionRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function app;

class QuestionRepositoryTest extends TestCase
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
        $question = Question::factory()->create();

        $this->assertDatabaseHas('questions', [
            'question' => $question->question,
            'status'   => $question->status,
            'user_id'  => $question->user_id
        ]);

        $newStatus = $this->faker->randomElement(['Not Answered', 'Answered', 'In Progress', 'SPAM']);

        $this->getQuestionRepositoryInstance()->update([
            'status' => $newStatus
        ], $question->id);

        $this->assertDatabaseHas('questions', ['id' => $question->id, 'status' => $newStatus]);
    }

    /**
     * @return \App\Repositories\QuestionRepository
     */
    public function getQuestionRepositoryInstance() : QuestionRepository
    {
        return app()->get(QuestionRepository::class);
    }
}
