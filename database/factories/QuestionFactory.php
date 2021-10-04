<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::pluck('id')->toArray();
        $userId = count($users) ? $this->faker->randomElement($users) : User::factory()->create()->id;

        return [
            'user_id'  => $userId,
            'question' => $this->faker->text,
            'status'   => $this->faker->randomElement(['Not Answered', 'Answered', 'In Progress', 'SPAM'])
        ];
    }
}
