<?php

namespace App\Events\Message;

use App\Model\Message;

class Created
{
    public $model;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $model)
    {
        $this->model = $model;
    }
}
