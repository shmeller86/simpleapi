<?php

class Router {
    private $routes;
    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }
    
    private function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    
     public function run()
    {
            //получить строку запроса
            $uri = $this->getURI();
            
            //проверить наличие такого запроса в routes.php
            foreach ($this->routes as $uriPattern =>$path) {
               //сравниваем $uriPattern и $uri
               if (preg_match("~$uriPattern~", $uri)) {

                   //получаем внутренний путь из внешнего согласно правилу
                   $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                  //определить какой контроллер и экшн обрабатывает запрос
                   $segments = explode('/', $internalRoute);
                   $controllerName = array_shift($segments).'Controller';
                   $controllerName = ucfirst($controllerName);

                   $actionName = 'action'.ucfirst(array_shift($segments));

                   $parameters = $segments;
                   
                   //echo $controllerName;
                   //подключить файл класса-контроллера
                   $controllerFile = ROOT.'/controllers/'.
                           $controllerName.'.php';
                   if (file_exists($controllerFile)) {
                       include_once($controllerFile);
                   }
                    //echo json_encode($this->answer);
                   //создаем объект, вызвать метод
                   $controllerObject = new $controllerName;
                   if (!$result = call_user_func_array(array($controllerObject, $actionName), $parameters)) Router::ErrorPage404();
                   if ($result != null) {
                       break;
                   }
               }
            }
    }
    function ErrorPage404()  {
        header('HTTP/1.1 404 Not Found');
        header("Location:404");
    }
}
