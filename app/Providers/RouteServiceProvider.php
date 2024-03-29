<?php

namespace App\Providers;

use App\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        //$this->mapApiRoutes();

        $this->mapBackRoutes();

        $this->mapFrontRoutes();
    }

    public function mapBackRoutes(): void
    {
        Route::middleware('web')
            ->namespace($this->namespace . '\\Back')
            ->group(base_path('routes/back.php'));
    }

    public function mapFrontRoutes(): void
    {
        Route::bind('postSlug', function ($slug) {
            return Post::where('slug', $slug)->first() ?? abort(404);
        });

        Route::middleware(['web', 'web-frontend'])
            ->namespace($this->namespace . '\\Front')
            ->group(base_path('routes/front.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
