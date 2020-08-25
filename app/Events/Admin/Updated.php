<?php

namespace App\Events\Admin;

use App\Model\Admin;

class Updated
{
    public $model;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Admin $model)
    {
        $this->model = $model;
    }
}
