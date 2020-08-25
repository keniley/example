<?php

namespace App\Observers;

use App\Model\Content;
use Illuminate\Support\Facades\Auth;

class ContentObserver
{
    /**
     * Handle the model content "creating" event.
     *
     * @param  \App\ModelContent  $modelContent
     * @return void
     */
    public function creating(Content $content)
    {
        $content->create_admin_id = Auth::guard('admin')->id();
        $content->update_admin_id = Auth::guard('admin')->id();
        $content->active = 0;
    }

    /**
     * Handle the model content "saving" event.
     *
     * @param  \App\ModelContent  $modelContent
     * @return void
     */
    public function saving(Content $content)
    {
        $content->update_admin_id = Auth::guard('admin')->id();
    }    
}
