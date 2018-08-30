<?php

class Signup extends Controller{
 
    //init
    public function Index()
    {      

        if(isset($_POST['submit']))
        {       
            
            $first =  $_POST['first'];
            $last = $_POST['last'];
            $email = $_POST['email'];
            $uid = $_POST['uid'];
            $pwd = trim($_POST['pwd']);        
  
            
            //check all fields
            $validateErr[] = $this->validate($first, $last, $email, $uid, $pwd);
            
           //has errors
            if(!empty($validateErr[0]))
            {
               
                // send view with error message 
                   $this->view('signup', [
                                            'signUpMsg' => $validateErr[0],
                                            'msgColor' => 'msgColorRed'
                                        ]
                   );             

                   exit();
      
            }else{
                
                 if(empty($validateErr[0]))
                 {   

                    $userExists = $this->model('user')->checkUserExists($uid);

                    //user already exists
                    if($userExists == 1)
                    {

                    //User Exists error message  
                        $signUpMsg[0] = 'This user already exists';

                        $this->view('signup', [
                                                'signUpMsg' => $signUpMsg,
                                                'msgColor' => 'msgColorRed'
                                              ]
                        );

                        exit();
                    }


                 }
   
            //insert into DB    
                
                $result = $this->model('user')->insertUser($first, $last, $email, $uid, $pwd);
   
                if($result){
                    
                    //return success message    
                    
                    $getInserted = $this->model('user')->getUser($uid);

                    $signUpMsg[0] = 'Sign Up Successful - <strong>' . $getInserted[0]['uid'] . '</strong> was added.';
                                     
                    $this->view('signup', [
                                            'signUpMsg' => $signUpMsg,
                                            'msgColor' => 'msgColorGreen'
                                          ]
                    );
                    
                }else{
                    
                     //return error message    
                    $signUpMsg[0] = 'Sign Up Error';

                    $this->view('signup', [
                                            'signUpMsg' => $signUpMsg,
                                            'msgColor' => 'msgColorRed'
                                          ]
                    );
                    
                }
                
            }
  
        }
        
        $this->view('signup');
    }
    
    
    //validate form
    public function validate($first, $last, $email, $uid, $pwd){
        
        $errMsg = [];
      
             /*check for empties*/
             
             //if first name is empty
             if(empty($first))
             {               
                 $errMsg[] =  'First Name Field is empty';       
             }
             
             //if Last name is empty    
             if(empty($last))
             {             
                 $errMsg[] =  'Last Name Field is empty'; 
             }
                
             //if email is empty    
             if(empty($email))
             {             
                 $errMsg[] =  'Email Field is empty'; 
             }
             
             //email filter
             if($email)
             {
                 if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                     
                    $errMsg[] = 'The Email format is incorrect';
                    
                 }
             }

             //check characters for first name
             if(!preg_match("/^[a-zA-Z]*$/", $first))
             {
                 $errMsg[] =  'Please check your First Name'; 
             }
             
             //check characters for last name
             if(!preg_match("/^[a-zA-Z]*$/", $first))
             {
                 $errMsg[] =  'Please check your Last Name'; 
             }
             
             //if Username is empty    
             if(empty($uid))
             {             
                 $errMsg[] =  'Username Field is empty'; 
             }
             

             //if password is empty    
             if(empty($pwd))
             {             
                 $errMsg[] =  'Password Field is empty'; 
             }
             

        return $errMsg;  
        
    }

}
