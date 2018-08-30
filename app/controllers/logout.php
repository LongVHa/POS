<?php

class Logout extends Controller{

    public function Index(){
        
        if(isset($_POST['logout'])){
  
            session_start();
            session_unset();
            session_destroy();
            
            $msg = 'You have logged out';
            
            $this->view('index', 
                    ['logoutMsg' => $msg,
                     'msgColor' => 'msgColorOrange'
                    ]);
            exit();
            
        }
    }

}
