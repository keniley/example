<?php

namespace App\Listeners;

use App\Service\CompanyService;

class CompanySubscriber
{
    private $companyService;

    /**
     * Create the event subscriber.
     *
     * @return void
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function refreshCache($event)
    {
        $this->companyService->refresh();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        
        $events->listen(
            'App\Events\Company\Updated',
            'App\Listeners\CompanySubscriber@refreshCache'
        );

        $events->listen(
            'App\Events\Company\Created',
            'App\Listeners\CompanySubscriber@refreshCache'
        );

        $events->listen(
            'App\Events\Company\Deleted',
            'App\Listeners\CompanySubscriber@refreshCache'
        );
        
    }
}