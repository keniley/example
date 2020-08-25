<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Model\Content;
use App\Observers\ContentObserver;
use App\Service\OfficeService;
use App\Service\CompanyService;
use App\Service\ContentService;
use App\Service\AlertService;
use App\Service\MessageService;
use App\Service\Email;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        OfficeService::class => OfficeService::class,
        CompanyService::class => CompanyService::class,
        ContentService::class => ContentService::class,
        AlertService::class => AlertService::class,
        MessageService::class => MessageService::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Email::class, function ($app) {
            return new Email();
        });

        $this->app->alias(Email::class, 'Email');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Content::observe(ContentObserver::class);
    }
}
