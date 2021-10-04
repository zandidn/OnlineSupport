<?php

namespace Database\Factories;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Answer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::pluck('id')->toArray();
        $userId = count($users) ? $this->faker->randomElement($users) : User::factory()->create()->id;
        $questions = Question::pluck('id')->toArray();
        $questionId = count($questions) ? $this->faker->randomElement($questions) : Question::factory()->create()->id;

        return [
            'question_id' => $questionId,
            'user_id'     => $userId,
            'answer'      => $this->faker->text,
        ];
    }
}
