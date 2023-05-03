<?php

namespace App\Http\Controllers\Auth;

use App\Entity\User;
use App\Http\Controllers\Controller;
use App\Repository\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use LaravelDoctrine\ORM\Facades\EntityManager;

class UserController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {
    }

    public function index(): View
    {
        return view('auth.user-index', [
            'users' => $this->userRepository->getUsers(),
        ]);
    }

    public function remove(User $user)
    {
        EntityManager::remove($user);
        EntityManager::flush();

        return new RedirectResponse(route('user.index'));
    }
}
