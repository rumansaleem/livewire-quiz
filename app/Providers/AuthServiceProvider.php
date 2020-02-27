<?php

namespace App\Providers;

use App\Events\PlayerJoined;
use App\Extentions\ConfigUserProvider;
use App\PlayerSession;
use App\Policies\QuizSessionPolicy;
use App\QuizPlayer;
use App\QuizSession;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        QuizSession::class => QuizSessionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('config', function($app, array $config) {
            return new ConfigUserProvider($config['password'], $config['name'] ?? null);
        });

    }
}
