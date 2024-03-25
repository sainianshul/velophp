<?php

namespace App\Core;

use \App\Core\Http\Route;
use \App\Core\Http\Request;

class App
{
     private Request $request;
    public function __construct(private Route $routes)
    {
    }

    public function run(Request $request)
    {

        $this->request = $request;

        $request_method = strtoupper($request->server('REQUEST_METHOD'));

        $uri = $request->server('REQUEST_URI');
          
       $uri = explode('?',$uri)[0];

        
        if ($_ENV['URI'] != '') {
            $uri = substr($uri, strlen($_ENV['URI']));
            $uri = explode('?', $uri)[0];
        }

        $routes = $this->routes->getRoutes();


        if (array_key_exists($uri, $routes[$request_method])) {

         
           $middleware = $this->routes->getMiddlewares();

             if(!empty(($middleware[$request_method][$uri]))){

           
               $middlewares = $middleware[$request_method][$uri];

               foreach($middlewares as $middleware) {

                   $middlewareClass = '\App\Middlewares\\' . $middleware;
                   if(class_exists($middlewareClass)){
                $middlewareInstance = new $middlewareClass();
                $middlewareInstance->handle($this->request);
                 }else{
                    echo "class ".$middlewareClass . " Not Found";
                    exit;
                 }
               }

             }




            if (is_array($routes[$request_method][$uri])) {
                $class = new $routes[$request_method][$uri][0] ?? null;
                if ($class) {
                    $method = $routes[$request_method][$uri][1];
                    if (is_callable([$class, $method])) {
                        call_user_func_array([$class, $method], [$this->request]);
                    } else {
                        echo "Function is Not callable";
                    }
                } else {
                    echo "class Not found";
                }
            } else {
                $routes[$request_method][$uri]();
            }
        } else {
            echo "Value Not set for " . $uri;
        }



    }
}
