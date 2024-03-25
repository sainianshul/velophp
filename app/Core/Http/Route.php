<?php 
declare(strict_types=1);
namespace App\Core\Http;


class Route{


private array $routes = [];
private array $middlewares = [];


public function get(string $uri,callable|array $fun,array $middleware = []) : self{

  $this->register("GET",$uri,$fun,$middleware);

  return $this;

}

public function post(string $uri, callable|array $fun,array $middleware = []) : self{

 $this->register("POST",$uri,$fun,$middleware);

 return $this;

}



public function register(string $request_method,string $uri, callable|array $fun, array $middleware = []) : self {
   
   $request_method = strtoupper($request_method);

   $this->routes[$request_method][$uri] = $fun;
   if(!empty($middleware)){
   $this->middlewares[$request_method][$uri] = $middleware;
    }
   return $this;

}


public function getRoutes(){

     return $this->routes;

}


public function getMiddlewares(){

     return $this->middlewares;

}

 
} // Route End