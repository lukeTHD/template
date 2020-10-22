<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Login;
use App\Http\Requests\StoreUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AuthController extends Controller
{

    protected $user;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Login $request)
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json([
                'status' => false,
                'code' => code('UNAUTHORIZAED'),
                'message' => 'failed',
                'data' => []
            ]);
        }

        $this->user->updateToken(auth()->user()->id, $token);

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {

//        dd($request->headers->all());

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => auth()->user()
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(StoreUser $request)
    {

        $user = $this->user->addUser($request->all());

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => [$user]
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => []
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'success',
            'data' => [
                [
                    'user' => [auth()->user()],
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->factory()->getTTL() * 60,
                ]
            ]
        ]);
    }
}
