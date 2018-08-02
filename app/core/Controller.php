<?php

class Controller {
    
    //get model
    public function model($modelName){
       require_once '../app/models/' . $modelName . '.php';
       return new $modelName();
    }
  
    //get view
    public function view($viewName, $data =  []){       
        require_once '../app/views/' . $viewName . '.php';
    }
}

