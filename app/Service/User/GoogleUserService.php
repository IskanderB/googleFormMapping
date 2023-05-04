<?php

namespace App\Service\User;

use App\Repository\UserRepository;

class GoogleUserService
{
    const GOOGLE_EMAIL_HOST = 'gmail.com';

    public function __construct(
        private readonly UserRepository $userRepository,
    ) {
    }

    public function getGoogleUserEmails(): array
    {
        return $this->userRepository->getUserEmailsByHost(self::GOOGLE_EMAIL_HOST);
    }
}
