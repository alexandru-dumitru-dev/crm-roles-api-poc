<?php

namespace App\Http\Controllers;

use App\Enums\RolesEnum;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password) || $user->hasRole(RolesEnum::STUDENT)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return ['token' => $user->createToken(Str::random())->plainTextToken];
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return ['message' => 'Successfully logged out'];
    }

    public function me()
    {
        return new UserResource(auth()->user());
    }
}
