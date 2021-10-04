<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnswerResource;
use App\Repositories\QuestionRepository;
use App\Repositories\AnswerRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AnswerController extends Controller
{

    /**
     * @var \App\Repositories\UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * @var \App\Repositories\QuestionRepository
     */
    protected QuestionRepository $questionRepository;

    /**
     * @var \App\Repositories\AnswerRepository
     */
    protected AnswerRepository $answerRepository;

    /**
     * UserController constructor.
     *
     * @param \App\Repositories\User\UserRepository     $userRepository
     * @param \App\Repositories\User\QuestionRepository $questionRepository
     * @param \App\Repositories\User\AnswerRepository   $answerRepository
     */
    public function __construct(
        UserRepository $userRepository,
        QuestionRepository $questionRepository,
        AnswerRepository $answerRepository
    ) {
        $this->userRepository = $userRepository;
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
    }

    public function index()
    {
        $result = $this->answerRepository->getUserAnswers();
        $collection = AnswerResource::collection($result);

        return response()->json([
            'success' => true,
            "status"  => "success",
            "message" => "OK",
            "data"    => $collection
        ])->setStatusCode(200);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'question_id' => 'required|integer',
            'answer'      => 'required|string',
        ]);

        $result = $this->answerRepository->replyQuestion($request);
        $answer = new AnswerResource($result);

        return response()->json([
            'success' => true,
            "status"  => "success",
            "message" => "OK",
            "data"    => $answer
        ])->setStatusCode(200);
    }
}
