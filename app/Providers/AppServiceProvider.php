<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event; // Adicione esta linha
use App\Events\ExportCompleted; // Adicione esta linha
use App\Listeners\NotifyUserExportCompleted; // Adicione esta linha

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        // Registrar o evento e o listener
        Event::listen(
            ExportCompleted::class,
            NotifyUserExportCompleted::class
        );
    }
}
