<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use \stdClass;

class AuthController extends Controller
{
    Public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
        ->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    Public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()
            ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
        ->json([
           'message' => 'Hi ' . $user->name,
           'accessToken' => $token,
           'token_type' => 'Bearer',
           'user' => $user,
        ]);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];


    }

    public function check(Request $request){
        if (!Auth::attempt($request->only('token'))) {
            return response()
            ->json(['message' => 'Unauthorized'], 401);
        }

        $usertoken = Auth::user()->tokens();

        $token = $request['token'];
        if ($token != $usertoken) {
            return response()
            ->json(['valid' => 'False',
                    'message' => 'Invalid Token'], 401);

        }
        else {
            return response()
            ->json(['valid' => 'True',
                    'message' => 'Valid Token']);
        }
    }
}
