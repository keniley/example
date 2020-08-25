<?php

namespace App\Events\Subscriber;

use App\Model\Subscriber;

class Created
{
    public $model;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Subscriber $model)
    {
        $this->model = $model;
    }
}