<?php

namespace App\Http\Middleware;

use App\Entity\User;
use App\Enum\Role;
use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function __construct(
        private readonly Role $adminRole,
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var User $user */
        $user = $request->user();

        if (in_array($this->adminRole->value, $user->getRoles()) === false) {
            return redirect('home');
        }

        return $next($request);
    }
}
