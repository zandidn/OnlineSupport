<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * @var \App\Repositories\UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * UserController constructor.
     *
     * @param \App\Repositories\User\UserRepository $userRepository
     */
    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $result=$this->userRepository->login($request);
        return $result;
    }

    public function index()
    {
        $result = $this->userRepository->paginate(10);
        $collection = UserResource::collection($result);

        return response()->json([
            'success' => true,
            "status"  => "success",
            "message" => "OK",
            "data"    => $collection
        ])->setStatusCode(200);
    }
}
