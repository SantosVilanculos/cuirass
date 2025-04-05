<?php

declare(strict_types=1);

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(App::isProduction());

        Model::shouldBeStrict((bool) App::environment(['local', 'testing']));
        Model::unguard();

        Paginator::useBootstrapFive();

        Password::defaults(fn () => when(App::isProduction(), Password::min(8)->max(24)->uncompromised()));

        RedirectIfAuthenticated::redirectUsing(fn () => route('dashboard'));
    }
}
