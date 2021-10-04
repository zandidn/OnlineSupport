<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\QuestionRepository;
use App\Http\Resources\QuestionResource;

class QuestionController extends Controller
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
     * UserController constructor.
     *
     * @param \App\Repositories\User\UserRepository     $userRepository
     * @param \App\Repositories\User\QuestionRepository $questionRepository
     */
    public function __construct(
        UserRepository $userRepository,
        QuestionRepository $questionRepository
    ) {
        $this->userRepository = $userRepository;
        $this->questionRepository = $questionRepository;
    }

    public function index()
    {
        $result = $this->questionRepository->paginate(10);
        $collection = QuestionResource::collection($result);

        return response()->json([
            'success' => true,
            "status"  => "success",
            "message" => "OK",
            "data"    => $collection
        ])->setStatusCode(200);
    }

    public function userQuestion()
    {
        $result = $this->questionRepository->getUserQuestion();
        $collection = QuestionResource::collection($result);

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
            'question' => 'required|string',
        ]);

        $result = $this->questionRepository->createQuestion($request);
        $question = new QuestionResource($result);

        return response()->json([
            'success' => true,
            "status"  => "success",
            "message" => "OK",
            "data"    => $question
        ])->setStatusCode(200);
    }

    public function searchUserQuestion(Request $request)
    {
        $validator = $request->validate([
            'customer_name' => 'required|string',
        ]);
        $result = $this->questionRepository->searchUserQuestion($request);
        $collection = QuestionResource::collection($result);

        return response()->json([
            'success' => true,
            "status"  => "success",
            "message" => "OK",
            "data"    => $collection
        ])->setStatusCode(200);
    }


    public function searchQuestionStatus(Request $request)
    {
        $validator = $request->validate([
            'status' => 'required|string',
        ]);
        $result = $this->questionRepository->searchQuestionStatus($request);
        $collection = QuestionResource::collection($result);

        return response()->json([
            'success' => true,
            "status"  => "success",
            "message" => "OK",
            "data"    => $collection
        ])->setStatusCode(200);
    }

    public function markSpam(Request $request)
    {
        $validator = $request->validate([
            'question_id' => 'required|integer',
        ]);

        $result = $this->questionRepository->markSpam($request);
        $question = new QuestionResource($result);

        return response()->json([
            'success' => true,
            "status"  => "success",
            "message" => "OK",
            "data"    => $question
        ])->setStatusCode(200);
    }
}
