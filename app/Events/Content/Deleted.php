<?php

namespace App\Events\Content;

use App\Model\Content;

class Deleted
{
    public $model;

    /**
     * Create a new event instance.
     *
     * @param  \App\Model\Content  $content
     * @return void
     */
    public function __construct(Content $model)
    {
        $this->model = $model;
    }
}