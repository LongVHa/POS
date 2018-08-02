<?php

/*
 @Check and require in Controllers
 @Parse URL
 @create new obj from required files and handle params
 @main routing
*/

class App{
    
    protected $controller = 'home';
    
    protected $method = 'index';
    
    protected $params = [];

    public function __construct() 
    {
        //get typed in URL
       $url = $this->parseUrl();

       //check if a controller file exist to a URL param typed
       if(file_exists('../app/controllers/' . $url[0] . '.php')){
           
           //set controller to URL [0] / replace default 'home' controller above
           $this->controller = $url[0];
           
           unset($url[0]);
       }
       
       //require in the file
       require_once '../app/controllers/' . $this->controller. '.php';
       
       //create new object from the required file
       $this->controller = new $this->controller;
       
       //check if a method exists on the new object
       if(isset($url[1])){
           
            if(method_exists($this->controller, $url[1])){
                
                //set default method to new method in url[1]
                $this->method = $url[1];
                unset($url[1]);      
            }
       } 
       
       //check if URL contains a value, if not use empty object
       $this->params = $url ? array_values($url) : [];
       
       //call method of the controller's, and pass in params
       call_user_func_array([$this->controller, $this->method], $this->params); 
    } 
    
    public function parseUrl() 
    {
        if(isset($_GET['url'])){
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
    
}
