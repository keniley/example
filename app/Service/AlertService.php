<?php

namespace App\Service;

use Illuminate\Support\Facades\Cache;
use App\Model\Alert;

/**
 * Class AlertService
 * @package App\Service
 */
class AlertService
{
    const DEFAULT_KEY = 'alert';

    /**
     * @return $this
     */
    public function refresh()
    {
        Cache::forget(self::DEFAULT_KEY);

        Cache::forever(self::DEFAULT_KEY, Alert::where('active', '=', 1)->get()->toArray());

        return $this;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        // get head company
        $value = Cache::rememberForever(self::DEFAULT_KEY, function () {
            return Alert::where('active', '=', 1)->get()->toArray();
        });

        return $value;
    }

    public function disable(string $key): AlertService
    {
        $alert = Alert::find($key);

        if($alert === null) {
            $alert = new Alert();
            $alert->id = $key;
        }

        $alert->active = 0;
        $alert->save();

        return $this;
    }

    public function enable(string $key): AlertService
    {
        $alert = Alert::find($key);

        if($alert === null) {
            $alert = new Alert();
            $alert->id = $key;
        }

        $alert->active = 1;
        $alert->save();

        return $this;
    }
}
