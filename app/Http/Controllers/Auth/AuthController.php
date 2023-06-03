<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    /*
	 * Register new user
	*/

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $user = User::create($validatedData);

        if ($user) {

            $access_token = $user->createToken($request->email)->plainTextToken;
            return response(compact('user', 'access_token'), 200);
        } else

            return response()->json(null, 404);
    }

    /*
	 * Generate sanctum token on successful login
	*/
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $access_token = $user->createToken($request->email)->plainTextToken;
        return response(compact('user', 'access_token'), 200);
    }

    /*
	 * Logout user and delete his access_token
	*/
    public function logout(Request $request)
    {

        $user = $request->user();
        $user->currentAccessToken()->delete;
        return response('', 204);
    }
}
