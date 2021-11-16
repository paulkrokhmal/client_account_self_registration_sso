<?php

namespace Tests\Feature;

use App\Models\User;
use App\Repositories\UserRepository\EloquentUserRepository;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
//    use RefreshDatabase;
    /** @test */
    public function test_1_check_google_auth_user_creation()
    {
        $correctData = [
            'token' => 'ya29.a0ARrdaM8nAaeO-WBI-afNEKFcpnTnMiqztKKqghyriewSjb_rpbGyaODRuh0REly2mdZSEcKu-BZ5kfOB-_7ssAyUCnFco2TWYsld5uWLQAJH9OJNVXLMpKFWP7zDHQDcBrmH_S_PniDXAWXIZZ5CTtxiW',
            'id' => '108442899254089283813',
            'name' => 'Pavel Krokhmal',
            'email' => 'paul.krokhmal@gmail.com',
            'user' => [
                'name' => 'Pavel Krokhmal',
                'given_name' => 'Pavel',
                'family_name' => 'Krokhmal',
                'email' => 'paul.krokhmal123@gmail.com',
                'picture' => 'https://lh3.googleusercontent.com/a-/AOh14GiyBg3iJY8ux2cU1xCvhlqOZlIi9ZpbJ_ozD_BK=s96-c',
                'id' => '108442899254089283813',
                'verified_email' => true,
            ]
        ];

        $newUser = (new EloquentUserRepository())->createByGoogleOAuthData($correctData);
        $this->assertInstanceOf(User::class, $newUser);
    }

    /** @test */
    public function test_2_check_google_auth_user_creation_wrong_data()
    {
        $wrongData = [
            'token' => 'ya29.a0ARrdaM8nAaeO-WBI-afNEKFcpnTnMiqztKKqghyriewSjb_rpbGyaODRuh0REly2mdZSEcKu-BZ5kfOB-_7ssAyUCnFco2TWYsld5uWLQAJH9OJNVXLMpKFWP7zDHQDcBrmH_S_PniDXAWXIZZ5CTtxiW',
            'id' => '108442899254089283813',
            'name' => 'Pavel Krokhmal',
            'email' => 'paul.krokhmal1@gmail.com',
            'user' => [
                'name' => 'Pavel Krokhmal',
                'picture' => 'https://lh3.googleusercontent.com/a-/AOh14GiyBg3iJY8ux2cU1xCvhlqOZlIi9ZpbJ_ozD_BK=s96-c',
                'id' => '108442899254089283813',
                'verified_email' => true,
            ]
        ];

        $this->expectException(HttpException::class);

        $newUser = (new EloquentUserRepository())->createByGoogleOAuthData($wrongData);
    }

    /** @test */
    public function test_3_check_google_auth_existing_user_creation()
    {
        $correctData = [
            'token' => 'ya29.a0ARrdaM8nAaeO-WBI-afNEKFcpnTnMiqztKKqghyriewSjb_rpbGyaODRuh0REly2mdZSEcKu-BZ5kfOB-_7ssAyUCnFco2TWYsld5uWLQAJH9OJNVXLMpKFWP7zDHQDcBrmH_S_PniDXAWXIZZ5CTtxiW',
            'id' => '108442899254089283813',
            'name' => 'Pavel Krokhmal',
            'email' => 'paul.krokhmal5@gmail.com',
            'user' => [
                'name' => 'Pavel Krokhmal',
                'given_name' => 'Pavel',
                'family_name' => 'Krokhmal',
                'email' => 'paul.krokhmal2123@gmail.com',
                'picture' => 'https://lh3.googleusercontent.com/a-/AOh14GiyBg3iJY8ux2cU1xCvhlqOZlIi9ZpbJ_ozD_BK=s96-c',
                'id' => '108442899254089283813',
                'verified_email' => true,
            ]
        ];
        (new EloquentUserRepository())->createByGoogleOAuthData($correctData); // new user
        $this->expectException(QueryException::class);
        (new EloquentUserRepository())->createByGoogleOAuthData($correctData); // existing user
    }
}
