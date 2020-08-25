<?php

namespace App\Events\Options;

use Larapp\Options\Model\Option;

class RowUpdated
{
    public $option;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Option $option)
    {
        $this->option = $option;
    }
}
