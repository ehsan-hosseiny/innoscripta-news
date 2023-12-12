<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\AuthServiceInterface;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function __construct(private AuthServiceInterface $authServiceInterface)
    {
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $data = $this->authServiceInterface->register($request->email, $request->password);
        return response()->json(['message' => 'User registered successfully', 'data' => $data],Response::HTTP_CREATED);
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (!$data = $this->authServiceInterface->login($request->email, $request->password)) {
            return response()->json(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }
        return response()->json(['message' => 'User logged in successfully',
            'data' => $data['user'], 'token' => $data['token']],Response::HTTP_OK);
    }
}
