<?php

namespace App\Listeners;

use App\Service\OfficeService;
use App\Service\AlertService;
use App\Model\Office;

class OfficeSubscriber
{
    private $officeService;

    private $alertService;

    /**
     * Create the event subscriber.
     *
     * @return void
     */
    public function __construct(OfficeService $officeService, AlertService $alertService)
    {
        $this->officeService = $officeService;

        $this->alertService = $alertService;
    }

    public function defaultOffice($event)
    {
        $office = $event->model;

        if((bool)$office->default === true) {

            $this->officeService->clearDefaultWithout($office->id);
        }

        $office = Office::where([['default', '=', 1],['active', '=', 1]])->first();
        $this->alertService->disable('office.default.none');

        if($office === null) {
            $this->alertService->enable('office.default.none');
        }

        $this->alertService->refresh();

        $this->officeService->refresh();
    }
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Office\Updated',
            'App\Listeners\OfficeSubscriber@defaultOffice'
        );
    }
}