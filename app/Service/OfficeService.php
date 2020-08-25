<?php

namespace App\Service;

use Illuminate\Support\Facades\Cache;
use App\Model\Office;

class OfficeService
{
    const DEFAULT_KEY = 'office';

    public function refresh()
    {
        Cache::forget(self::DEFAULT_KEY);

        Cache::forever(self::DEFAULT_KEY, Office::where([['default', '=', 1],['active', '=', 1]])->first());

        return $this;
    }

    public function getDefault()
    {
        $value = Cache::rememberForever(self::DEFAULT_KEY, function () {
            return Office::where([['default', '=', 1], ['active', '=', 1]])->first();
        });

        if($value === null) {
            $value = new Office();
        }
        
        return $value;
    }

    public function getOffices()
    {
        return $company = Office::where('active', '=', 1)->get();
    }

    public function clearDefaultWithout($id)
    {
        $offices = Office::where([['default', '=', 1],['id', '!=', $id]])->get();

        foreach($offices as $item) {
            $item->default = 0;
            $item->save();
        }  
    }
}
