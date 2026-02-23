<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Quiz\QuizRepositoryInterface;
use App\Repositories\Quiz\EloquentQuizRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
     $this->app->bind(QuizRepositoryInterface::class, EloquentQuizRepository::class);
// sp yüklenirken container'a binding yapılır
// interface cagır edildiğinde Repository üretilir
// bind kullanıldığı için her  işlemde yeni instance oluşturulur
// singleton kullanılırsa 1 kez üretir
//
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
