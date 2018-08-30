<?php

$this->model('dbh');

class User extends DBH {
    
    protected function pdoRun($sql, $fetch)
    {
        
            $pdo = $this->DBconn();
            $stmt = $pdo->prepare($sql); 
  
            //no fetching
            if($fetch == 0)
            {
                $result = $stmt->execute();    
                return $result;
                
            //with fetching    
            }else if($fetch == 1){
                
                $stmt->execute();
                $result = $stmt->fetchAll();
            
                return $result;     
            }
    }


    public function insertUser($first, $last, $email, $uid, $pwd)
    {   
           //hashing password

            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO users(first, last, uid, email, password) VALUES ('$first', '$last', '$uid', '$email', '$hashedPwd');";
          
            try{
                
                $result = $this->pdoRun($sql, 0);//PDO with no fetch

                return $result;
                
            }catch(Exception $e){
                
                throw new $e;          
            }

    }
    
    public function checkUserExists($uid)
    {
            //check for existing Username

            $sql = "SELECT uid FROM users WHERE uid='$uid'";
            
            try{
                
                $result = $this->pdoRun($sql, 1);//PDO with fetch
          
                if (!empty($result) ) {
                    //user exists
                     return 1;
                } else { 
                    //user does not exists
                    return 0; 
                }
                
            }catch(Exception $ex){
                
                throw new $ex;       
            }
    }  
    
    public function getUser($uid){
        
        $sql = "SELECT * FROM users WHERE uid='$uid'";
        
        $result = $this->pdoRun($sql, 1);//PDO with fetch
        
        return $result;
        
    }
  
}


