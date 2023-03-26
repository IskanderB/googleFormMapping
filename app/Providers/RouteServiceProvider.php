<?php

namespace App\Providers;

use App\Entity\Row\Row;
use App\Entity\Task\Task;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use LaravelDoctrine\ORM\Facades\EntityManager;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        $this->bindTask();
        $this->bindRow();
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    private function bindRow(): void
    {
        $repository = EntityManager::getRepository(Row::class);

        Route::bind('row', function (int $id) use ($repository) {
            return $repository->findOneBy(['id' => $id]);
        });
    }

    private function bindTask(): void
    {
        $repository = EntityManager::getRepository(Task::class);

        Route::bind('task', function (?int $id) use ($repository) {
            return $id ? $repository->findOneBy(['id' => $id]) : new Task();
        });

        Route::bind('currentTask', function (?int $id) use ($repository) {
            return $repository->findOneBy(['id' => $id]);
        });
    }
}
