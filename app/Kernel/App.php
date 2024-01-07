<?php

namespace APP\Kernel;

use APP\Kernel\Request\Request;
use APP\Kernel\Router\Router;

class App
{
    public function run()
    {
        $router = new Router();
        $request = Request::createFromGlobals();

        $router->dispatch($request->uri(), $request->method());
    }
}