<?php

namespace App\Http\Controllers\API;

use App\Models\PublicUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;


class PublicAuthController extends ApiController
{
    public $apiPublicGuard = 'api-public';

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        //   $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return $this->failure('error', 422, $validator->errors());
        }
        if (!$token = auth($this->apiGuard)->attempt($validator->validated())) {
            return $this->failure('Unauthorized', 401, $validator->errors());
        }
        $this->message = 'Login';
        $this->status = '200';
        return $this->success($this->createNewToken($token));
    }


    /**
     * Register a User.
     *
     * @return JsonResponse
     */
    public function createPublicToken()
    {
        $user = auth()->user();
        $userId = $user->id;
        $publicUser = PublicUser::find($userId);
        if (!$publicUser) {
            $publicUser = new PublicUser();
        }
        $password = rand(10, 1000);
        $publicUser->password = bcrypt($password);
        $publicUser->user_id = $userId;
        $publicUser->save();

        if (!$token = auth($this->apiPublicGuard)->attempt(['user_id' => $userId, 'password' => $password])) {
            return $this->failure('Unauthorized', 401);
        }
        return $this->createNewToken($token);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth($this->apiPublicGuard)->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth($this->apiPublicGuard)->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth($this->apiPublicGuard)->user());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            //   'expires_in' => auth()->factory()->getTTL() * 60,
            'expires_in' => auth($this->apiPublicGuard)->factory()->getTTL() * 60,
            'user' => auth($this->apiPublicGuard)->user()
        ]);
    }

}
