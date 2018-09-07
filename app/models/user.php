<?php

//login user
include('pdoRun.php');

class User{

    private $pdoRun;
    
    public function __construct()
    {
            $this->pdoRun = new PdoRun();
    }
    
    //hashing password
    public function insertUser($first, $last, $email, $uid, $pwd)
    {   
          
            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
          
            $sql = "INSERT INTO users(first, last, uid, email, password) VALUES ('$first', '$last', '$uid', '$email', '$hashedPwd');";
          
            try{          
                
                $result = $this->pdoRun->pdoSql($sql, 'pdoExec');//PDO with no fetch
                return $result;
              
            }catch(Exception $e){               
                throw new $e;          
            }
    }
    
    
    //check for existing Username
    public function checkUserExists($uid)
    {
            
            $sql = "SELECT uid FROM users WHERE uid='$uid'";
            
            try{           
                $result = $this->pdoRun->pdoSql($sql, 'pdoFetch');//PDO with fetch
          
                return $result;
                
            }catch(Exception $ex){          
                throw new $ex;       
            }
    }  
    
    //get user id
    public function getUser($uid){
        
            $sql = "SELECT * FROM users WHERE uid='$uid'";     
            $result = $this->pdoRun->pdoSql($sql, 'pdoFetch');//PDO with fetch       
            return $result;
        
    }
  
}


