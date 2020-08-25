<?php

namespace App\Service;

use Illuminate\Support\Facades\Cache;
use App\Model\Message;

class MessageService
{
    const DEFAULT_KEY = 'message';

    public function refresh()
    {
        Cache::forget(self::DEFAULT_KEY);

        Cache::forever(self::DEFAULT_KEY, Message::where('shown', '=', 0)->count());

        return $this;
    }

    public function count()
    {
        // get head company
        $value = Cache::rememberForever(self::DEFAULT_KEY, function () {
            return Message::where('shown', '=', 0)->count();
        });

        return $value;
    }
}