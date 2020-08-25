<?php

namespace App\Events\Content;

use App\Model\Content;

class Updated
{
    public $model;

    public $data;

    /**
     * Create a new event instance.
     *
     * @param  \App\Model\Content  $content
     * @return void
     */
    public function __construct(Content $model, array $data = null)
    {
        $this->model = $model;

        $this->data = $data;
    }
}