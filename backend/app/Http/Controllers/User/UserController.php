<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repository\User\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Prophecy\Exception\Doubler\MethodNotFoundException;

class UserController extends Controller
{
    /** @var  \App\Repository\User\UserRepository */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Buscar um usuario pelo id
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function getById(int $id): JsonResponse
    {
        $user = $this->userRepository->find("id", $id);
        return response()->json($user, 200);
    }

    public function update(int $id, Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'email'    => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(["validator" => true, "message" => $validator->errors()], 404);
            }
            $data = $request->all();
            return response()->json($data, 200);
        } catch (MethodNotFoundException $e) {
            return response()->json(["message" => $e->getMessage()], 404);
        }
    }
}
