<?php

namespace App\Repositories;

use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{


    public function __construct(private $constantToken='')
    {
        $this->constantToken = config('constants.TOKEN_NAME');
    }

    /**
     * @inheritDoc
     */
    public function register(string $email, string $password):array
    {
        $user = User::create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        $token = $user->createToken($this->constantToken)->plainTextToken;
        return ['user'=>$user,'token'=> $token];
    }

    public function login(string $email,string $password)
    {
        if (auth()->attempt(['email'=>$email,'password'=>$password])) {
            $user = auth()->user();
            $token = $user->createToken('AuthToken')->plainTextToken;
            return ['user'=>$user,'token'=>$token];
        } else {
            return false;
        }
    }
}
