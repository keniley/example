<?php

namespace App\Events\Office;

use App\Model\Office;

class Deleted
{
    public $model;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Office $model)
    {
        $this->model = $model;
    }
}
