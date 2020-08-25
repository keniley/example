<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Auth;

class AdminSubscriber
{
    /**
     * Handle admin update event
     */
    public function logWhoUpdated($event) 
    {
        $admin = $event->model;
        
        $admin->update_admin_id = Auth::guard('admin')->id();
        $admin->save();
    }

    /**
     * Handle admin create event
     */
    public function logWhoCreated($event) 
    {
        $admin = $event->model;

        $admin->create_admin_id = Auth::guard('admin')->id();
        $admin->update_admin_id = Auth::guard('admin')->id();
        $admin->save();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Admin\Created',
            'App\Listeners\AdminSubscriber@logWhoCreated'
        );

        $events->listen(
            'App\Events\Admin\Updated',
            'App\Listeners\AdminSubscriber@logWhoUpdated'
        );
    }
}