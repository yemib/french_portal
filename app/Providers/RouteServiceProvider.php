<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
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
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();

        $this->mapStudentRoutes();

        $this->mapLecturerRoutes();

        $this->mapSupervisorRoutes();

        $this->mapBursarRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
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

    protected function mapAdminRoutes()
    {
        Route::prefix("admin")
            ->middleware(["web", "admin"])
            ->namespace($this->namespace."\Admin")
            ->group(base_path('routes/admin.php'));
    }

    protected function mapStudentRoutes()
    {
        Route::prefix("student")
            ->middleware(["web", "student"])
            ->namespace($this->namespace."\Student")
            ->group(base_path('routes/student.php'));
    }

    protected function mapLecturerRoutes()
    {
        Route::prefix("lecturer")
            ->middleware(["web", "lecturer"])
            ->namespace($this->namespace."\Lecturer")
            ->group(base_path('routes/lecturer.php'));
    }

    protected function mapSupervisorRoutes()
    {
        Route::prefix("supervisor")
            ->middleware(["web", "supervisor"])
            ->namespace($this->namespace."\Supervisor")
            ->group(base_path('routes/supervisor.php'));
    }

    protected function mapBursarRoutes()
    {
        Route::prefix("bursar")
            ->middleware(["web", "bursar"])
            ->namespace($this->namespace."\Bursar")
            ->group(base_path('routes/bursar.php'));
    }
}
