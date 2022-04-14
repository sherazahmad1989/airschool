<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;


class AuthController extends ApiController
{
    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|min:8',
        ]);
        if ($validator->fails()) {
            return $this->failure('email or user not found', 422, $validator->errors()->all());
        }
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $data['token'] = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            $data['type'] = 'Bearer';
            $data['name'] = auth()->user()->name;
            $data['email'] = auth()->user()->email;
            $this->message = 'Login';
            $this->status = '200';
            return $this->success($data);
        } else {
            return $this->failure('email or user not found', 401);
        }
    }

    /**
     * Register a User.
     *
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|min:8',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $token = $user->createToken('LaravelAuthApp')->accessToken;
        return response()->json(['token' => $token], 200);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth($this->guardName)->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth()->user());
    }


}
