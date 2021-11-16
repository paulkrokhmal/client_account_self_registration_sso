<?php

namespace App\Repositories\UserRepository;

interface UserRepositoryInterface {
    public function createByGoogleOAuthData($data);
}
