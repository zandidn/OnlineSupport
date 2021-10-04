<?php

namespace App\Repositories;

use App\Models\Answer;
use App\Repositories\Repository;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Container\Container as Application;

/**
 * Class AnswerRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AnswerRepository extends Repository
{
    /**
     * @var \App\Repositories\QuestionRepository
     */
    protected QuestionRepository $questionRepository;

    /**
     * UserRepository constructor.
     *
     * @param \Illuminate\Container\Container      $app
     * @param \App\Repositories\QuestionRepository $questionRepository
     */
    public function __construct(Application $app, QuestionRepository $questionRepository)
    {
        parent::__construct($app);
        $this->questionRepository = $questionRepository;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Answer::class;
    }

    public function getUserAnswers()
    {
        $user = Auth::user();
        $answers = $this->findByField('user_id', $user->id);

        return $answers;
    }

    public function replyQuestion(Request $request)
    {
        $user = Auth::user();
        $data = [
            'question_id' => $request['question_id'],
            'answer'      => $request['answer'],
            'user_id'     => $user->id,
        ];
        $answer = $this->create($data);
        $question = $this->questionRepository->markAnswered($request['question_id']);

        return $answer;
    }
}
