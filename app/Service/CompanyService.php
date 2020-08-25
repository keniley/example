<?php

namespace App\Service;

use Illuminate\Support\Facades\Cache;
use App\Model\Company;

class CompanyService
{
    const DEFAULT_KEY = 'company';

    public function refresh()
    {
        Cache::forget(self::DEFAULT_KEY);

        Cache::forever(self::DEFAULT_KEY, Company::find(1));

        return $this;
    }

    public function get()
    {
        // get head company
        $value = Cache::rememberForever(self::DEFAULT_KEY, function () {
            return Company::find(1);
        });

        return $value;
    }
}