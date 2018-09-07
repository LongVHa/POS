<?php

session_start();

class Login extends Controller
{
    
    public function Index()
    {   

        if(isset($_POST['login']))
        {
            $msg = [];
            
            $uid = $_POST['uid'];
            $pwd = $_POST['pwd'];
 
            //check for empties
            if(empty($uid) || empty($uid))
            {
                $msg[] =  'Please enter your login details';
                //send view with error message
                $this->getView('index', $msg, 'Red');  
                
                exit();
               
            }else{
                             
                //check if user exists
                $result = $this->model('user')->checkUserExists($uid);

                if($result == 0)//user doesnt exists
                {
                    //send view with error message
                    $msg[] = 'Cannot find user';
                    $this->getView('index', $msg, 'Red');
                    exit();
                    
                }else{
                    //check password
                    
                    $result = $this->checkPwd($uid, $pwd); 
                    
                    $this->getView('index', $result, 'Red');
                    
                }
            }         
        }      
        
        $this->getView('index', '', 'Red');
    }
    
    public function checkPwd($uid, $pwd){
        
        //get hashed password from DB
        $DbUser = $this->model('user')->getUser($uid);
          
        //compare password
        $hashedPwdCheck = password_verify($pwd, $DbUser[0]['password']);

        if($hashedPwdCheck == false)
        {
            //incorrect password
            $msg[] = 'incorrect password';
            return $msg;
          
        }elseif($hashedPwdCheck == true){
            
            //login in the user here
            $_SESSION['u_id'] = $DbUser[0]['id'];
            $_SESSION['u_first'] = $DbUser[0]['first'];
            $_SESSION['u_last'] = $DbUser[0]['last'];
            $_SESSION['u_email'] = $DbUser[0]['email'];
            $_SESSION['u_uid'] = $DbUser[0]['uid'];
      
            $this->getView('index', '', '');
                
        }       
    }
    
    protected function getView($view, $msg, $msgColor)
    {
            $this->view($view, [
                                    'loginMsg' => $msg,
                                    'msgColor' => 'msgColor'. $msgColor
                                  ]
            );
    } 

}