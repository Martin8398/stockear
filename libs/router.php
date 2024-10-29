<?php

require_once "./libs/req.php";
require_once "./libs/res.php";

class router {
    private $routeTable = [];
    private $middlewares = [];
    private $defaultRoute;
    private $req;
    private $res;

    public function __construct(){
        $this->defaultRoute = null;
        $this->req = new request();
        $this->res = new response();
    }

    public function route($url, $verb){
        foreach ($this->middlewares as $middleware) {
            $middleware->run($this->req, $this->res);
        }

        foreach($this->routeTable as $route){
            if($route->match($url, $verb)){

                $route->run($this->req, $this->res);
                die();
            }
        }
    }
    public function addMiddleware($middleware){
        $this->middlewares[] = $middleware;
    }

    public function addRoute($url, $verb, $controller, $method){
        $this->routeTable[] = new route($url, $verb, $controller, $method);
    }
    public function setDefaultRoute($controller, $method){
        $this->defaultRoute = new route("", "", $controller, $method);
    }
}
class route {
    private $url;
    private $verb;
    private $controller;
    private $method;
    private $params;

    public function __construct($url, $verb, $controller, $method){
        $this->url = $url;
        $this->verb = $verb;
        $this->controller = $controller;
        $this->method = $method;
        $this->params = [];
    }
    
    public function match($url, $verb){
        if($this->verb != $verb){
            return false;
        }
        $partsURL = explode("/", trim($url, "/"));
        $partsRoute = explode("/", trim($this->url, "/"));
        if(count($partsURL) != count($partsRoute)){
            return false;
        }
        foreach($partsRoute as $key => $part){ 
            if($part[0] != ":"){
                if($part != $partsURL[$key]){
                    return false;
                }
            } else {
                $this->params[''.substr($part,1)] = $partsURL[$key];
            }
        }
        return true;
    }
    public function run($req, $res){
        $controller = $this->controller;
        $method = $this->method;
        $req->params = (object) $this->params;

        (new $controller())->$method($req, $res);
    }
}