<?php

class Router
{
    private $routes;
    
    public function __construct()
    {
        $routesPath=ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }
    
    /* get request as link == string : true */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    
    public function run()
    {
        /* get requested path */
        $uri=$this->getURI();
        
        
        // check if there actually exists this path in routes.php
        foreach ($this->routes as $uriPattern => $path) {
            
            /* compare $uriPattern and $uri */
            if (preg_match("~$uriPattern~", $uri)) {
    
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                /*take Controller and Action name from URI */
                $segments = array_filter(explode('/', $internalRoute));
                $controllerName = ucfirst(array_shift($segments).'Controller');
                $actionName = 'action'.ucfirst(array_shift($segments));
               /* 
                echo '<br>user-side url: '.$uri;
                echo '<br>searching pattern: '.$uriPattern;
                echo '<br>replacing pattern: '.$path;
                echo '<br> constructed link: '.$internalRoute;
                echo '<br>_____________/controller/action/cat/id'.'<br><br>';
                echo '<br>controller name: '.$controllerName;
                echo '<br>action name: '.$actionName.'<br>';
                echo '<pre>';
                print_r($segments);
               */
                
                
                //  connect controller for this class
                $controllerFile = ROOT.'/controllers/' . $controllerName . '.php';
                
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }
        
                // create object, call action
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $segments);
                if ($result != null) break;
            }
        }
    }
}
