<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ReflectionClass;
use App\Model\Url;

use Illuminate\Routing\ControllerDispatcher;
use Illuminate\Routing\Route;

class FallbackController extends Controller
{
    public function show(Request $request, $slug = '')
    {
        $url = Url::where('slug', $slug)->first();

        if($url === null) {
            return response()->view('web.404', [], 404);
        }

        if($url->is_historic) {
            $newUrl = Url::where([
                ['controller', '=', $url->controller],
                ['object_id', '=', $url->object_id],
                ['is_historic', '=', 0]
            ])->first();

            if($newUrl) {
                return redirect($newUrl->slug);
            }
        }

        $namespace = (new ReflectionClass($this))->getNamespaceName();
        $controller = $namespace.'\\'.$url->controller;

        $container = app();

        $route = $container->make(Route::class);
        $route->forgetParameter('slug');
        $route->setParameter('id', $url->object_id);

        $controllerInstance = $container->make($controller);

        return (new ControllerDispatcher($container))->dispatch($route, $controllerInstance, 'show');
    }
}
