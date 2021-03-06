<?php

namespace App\Facade;

use Illuminate\Support\Facades\Facade;

class Email extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return  string
     */
    protected static function getFacadeAccessor()
    {
        return 'Email';
    }
}