<?php

namespace App\Events\Company;

use App\Model\Company;

class Created
{
    public $model;

    /**
     * Create a new event instance.
     *
     * @param  \App\Model\Company  $company
     * @return void
     */
    public function __construct(Company $model)
    {
        $this->model = $model;
    }
}