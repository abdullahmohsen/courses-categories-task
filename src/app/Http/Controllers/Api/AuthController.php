<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponseTrait;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $validation = Validator::make(request()->all(), [
            'email'    => 'required|email|exists:users,email',
            'password' => 'required',
        ]);
        if ($validation->fails()) {
            return $this->apiResponse(400, 'Validation Errors', $validation->errors());
        }
        $credentials = request(['email', 'password']);
        $token = auth()->attempt($credentials);
        if (!$token) {
            return $this->apiResponse(401, 'Bad credentials');
        }
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        $data = [
            'access_token' => $token,
            'name'         => Auth::user()->name,
            'expires_in'   => auth('api')->factory()->getTTL() * 3600
        ];
        return $this->apiResponse(200, 'Login success', NULL, $data);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();
        return $this->apiResponse(200, 'You have been successfully logged out');
    }


}
