<?php

namespace App\Providers;

use App\Services\Interfaces\ProjectServiceInterface;
use App\Services\Interfaces\TaskServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\Interfaces\UtilityServiceInterface;
use App\Services\ProjectService;
use App\Services\TaskService;
use App\Services\UserService;
use App\Services\UtilityService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register all application services or service layer here.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(ProjectServiceInterface::class, ProjectService::class);
        $this->app->bind(TaskServiceInterface::class, TaskService::class);
        $this->app->bind(UtilityServiceInterface::class, UtilityService::class);
    }
}
