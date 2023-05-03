<?php

namespace App\Http\Controllers\Auth;

use App\Entity\User;
use App\Enum\Role;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use LaravelDoctrine\ORM\Facades\EntityManager;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = (new User())
            ->setName($request->name)
            ->setEmail($request->email)
            ->setPassword(Hash::make($request->password))
            ->setRoles([Role::ROLE_USER->value]);

        EntityManager::persist($user);
        EntityManager::flush();

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
