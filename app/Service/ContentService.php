<?php

namespace App\Service;

use Illuminate\Support\Facades\Cache;
use App\Model\Content;

class ContentService
{
    const DEFAULT_KEY = 'content_';

    public function refresh(string $id)
    {
        Cache::forget(self::DEFAULT_KEY.$id);

        $content = Content::find($id);

        if($content) {
            Cache::forever(self::DEFAULT_KEY.$id, $content);
        }

        return $this;
    }

    public function get(string $id)
    {
        $content = Cache::get(self::DEFAULT_KEY.$id);

        if($content === null) {
            $content = Content::find($id);
            if($content) {
                Cache::forever(self::DEFAULT_KEY.$id, $content);
            }
        }

        return $content;
    }
}