<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Policy;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Post' => 'App\Policies\PostPolicy',
        'App\Category' => 'App\Policies\CategoryPolicy',
        'App\User' => 'App\Policies\UserPolicy',
        'App\Bot' => 'App\Policies\BotPolicy',
        'Spatie\Permission\Models\Role' => 'App\Policies\RolePolicy',

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Implicitly grant "Admin" role all permissions
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('admin') || $user->isSuperAdmin()) {
                return true;
            }
        });

        Gate::resource('invoices', 'App\Policies\InvoicePolicy');
        Gate::define('invoices.index', 'App\Policies\InvoicePolicy@index');

        Gate::resource('subscriptions', 'App\Policies\SubscriptionPolicy');
        Gate::define('subscriptions.index', 'App\Policies\SubscriptionPolicy@index');

        Gate::define('phones.call', 'App\Policies\PhonePolicy@call');

//        Gate::resource('invoices', 'App\Policies\InvoicePolicy');

        Passport::routes();

        Passport::tokensExpireIn(now()->addDays(30));
        Passport::refreshTokensExpireIn(now()->addDays(60));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
