<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Servico;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Relations\Relation;

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
    Relation::morphMap([
        'produto' => Produto::class,
        'servico' => Servico::class,
    ]);
}
}
