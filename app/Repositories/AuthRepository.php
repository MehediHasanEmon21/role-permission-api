<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\NewAccessToken;

class AuthRepository
{
    public function login($data): array
    {

        $user = $this->findUserByEmail($data['email']);

        if (! $user) {
            throw new Exception('User Email not exists', 404);
        }

        if (! $this->isValidPassword($data['password'], $user)) {
            throw new Exception('Password is not correct', 404);
        }

        $tokenInstance = $this->createAuthToken($user);

        return $this->getAuthData($user, $tokenInstance);

    }

    public function findUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function isValidPassword(string $password, User $user): bool
    {
        return Hash::check($password, $user->password);
    }

    public function createAuthToken(User $user): NewAccessToken
    {
        return $user->createToken('authToken');
    }

    public function getAuthData(User $user, NewAccessToken $tokenInstance): array
    {
        return [
            'user' => $user,
            'access_token' => $tokenInstance->plainTextToken,
            'token_type' => 'Bearer',
        ];
    }
}
