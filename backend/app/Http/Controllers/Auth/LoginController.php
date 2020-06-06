<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class LoginController extends Controller
{
    /** @var \App\User */
    protected $user;

    /** @var \Tymon\JWTAuth\JWTAuth */
    protected $jwt;

    public function __construct(User $user, JWTAuth $jwt)
    {
        $this->user = $user;
        $this->jwt = $jwt;
    }

    /**
     * Validar credenciais
     *
     * @param Request $request
     * @return array
     */
    private function loginCredentials(Request $request): array
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            throw new BadRequestException('Credenciais invalidas');
        }
        return [
            'email' => $request->post('email'),
            'password' => $request->post('password')
        ];
    }

    /**
     * Authenticar credencias
     *
     * @param Request $request
     * @return string
     */
    private function authenticate(Request $request): string
    {
        $credenciais = $this->loginCredentials($request);
        if (!($token = $this->jwt->attempt($credenciais))) {
            return false;
        }
        return $token;
    }


    /**
     * Retornar dados
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        $token = $this->authenticate($request);
        $user = Auth::user();
        return response()->json(['user' => $user, 'token' => $token], 200);
    }

    public function logout()
    {
        if (Auth::user()) {
            Auth::logout();
            return response()->json(["status" => true], 200);
        }
        return response()->json(["status" => false], 401);
    }
}
