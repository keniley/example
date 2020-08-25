<?php

namespace App\Service;

use App\Model\Url;
use Illuminate\Support\Str;

class UrlService
{
    private $controller;

    private $object;

    private $slug = '';

    private $static = null;

    private $title = '';

    public function setController(?string $controller): UrlService
    {
        $this->controller = $controller;

        return $this;
    }

    public function setObject(?string $object): UrlService
    {
        $this->object = $object;

        return $this;
    }

    public function setSlug(?string $slug): UrlService
    {
        if(Str::startsWith($slug, '/')) {
            $slug = substr($slug, 1); 
        }

        $this->slug = $slug;

        return $this;
    }

    public function setTitle(?string $title): UrlService
    {
        $this->title = $title;

        return $this;
    }

    public function setStatic(?bool $static): UrlService
    {
        $this->static = $static;

        return $this;
    }

    public function generate()
    {
        if($this->slug !== '' && $this->static === true) {
            return $this->createByHand();
        }

        if($this->static === false) {
            $this->removeAllStatic();
        }

        $this->slug = Str::slug($this->title, '-');

        $active_url = $this->findActiveUrl();

        if($active_url === null) {

            $historic = $this->getHistoricBySlug();
            
            if($historic) {
                $historic->is_historic = false;
                $historic->is_static = false;
                $historic->save();
                return $historic;
            }

            return $this->create();
        }

        if((bool)$active_url->is_static === false) {
            if($this->slug !== $active_url->slug) {
                $this->deactivateAll();

                $historic = $this->getHistoricBySlug();
            
                if($historic) {
                    $historic->is_historic = false;
                    $historic->is_static = false;
                    $historic->save();
                    return $historic;
                }
                
                return $this->create();
            }
        }

        return $active_url;
    }


    private function createByHand()
    {
        $this->deactivateAll();            

        $historic = $this->getHistoricBySlug();
        
        if($historic) {
            $historic->is_historic = false;
            $historic->is_static = true;
            $historic->save();
            return $historic;
        }

        return $this->create();
    }


    private function create()
    {
        $static = $this->static;

        if($static === null) {
            $static = false;
        }

        $url = new Url();
        $url->slug = $this->generateSlug($this->slug);
        $url->controller = $this->controller;
        $url->object_id = $this->object;
        $url->is_static = $static;
        $url->is_historic = false;
        $url->save();

        return $url;
    }

    private function removeAllStatic()
    {
        Url::where([
            ['object_id', '=', $this->object],
            ['controller', '=', $this->controller],
        ])->update(['is_static' => 0]);
    }

    private function deactivateAll()
    {
        Url::where([
            ['object_id', '=', $this->object],
            ['controller', '=', $this->controller],
        ])->update(['is_historic' => 1, 'is_static' => 0]);
    }

    private function getHistoricBySlug()
    {
        return Url::where([
            ['object_id', '=', $this->object],
            ['controller', '=', $this->controller],
            ['slug', '=', $this->slug],
            ['is_historic', '=', 1]
        ])->first();
    }

    private function findActiveUrl()
    {
        return Url::where([
            ['object_id', '=', $this->object],
            ['controller', '=', $this->controller],
            ['is_historic', '=', 0]
        ])->first();
    }

    private function generateSlug($slug, $append = null)
    {
        $add = '';

        if($append !== null) {
            $add = '-'.$append;
        }

        $url = Url::where('slug', '=', $slug.$add)->first();

        if($url) {
            return $this->generateSlug($slug, $append + 1);
        }

        return $slug.$add;
    }
}