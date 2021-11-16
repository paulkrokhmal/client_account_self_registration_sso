<?php

namespace App\Repositories\UserRepository;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function createByGoogleOAuthData($data)
    {
        $rules = [
            'token' => 'required',
            'id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'user.name' => 'required',
            'user.given_name' => 'required',
            'user.family_name' => 'required',
            'user.email' => 'required|email',
            'user.picture' => 'required',
            'user.id' => 'required',
            'user.verified_email' => 'required',
        ];

        if (!Validator::make($data, $rules)->passes()) {
            abort(500);
        }

        $userDetails = $data['user'];

        return User::create([
            'name' => $userDetails['name'],
            'first_name' => $userDetails['given_name'],
            'last_name' => $userDetails['family_name'],
            'email' => $userDetails['email'],
            'profile' => $userDetails['picture'],
            'social_id' => $userDetails['id'],
            'social_type' => 'Google',
            'email_verified_at' => $userDetails['verified_email'] ? Carbon::now() : null,
            'password' => encrypt('google-password')
        ]);
    }
}
