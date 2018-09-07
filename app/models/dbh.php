<?php

class DBH{
    
     private static $dbHost = 'localhost';
     private static $dbUsername = 'root';
     private static $dbPassword = '';
     private static $dbName = 'pos';
    
    //connect to DB
    private function _DBconn()
    {
        //set DSN
        $dsn = 'mysql:host=' . self::$dbHost . ';dbname=' . self::$dbName;

        //create PDO instance
        $pdo = new PDO($dsn, self::$dbUsername, self::$dbPassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        
        return $pdo;
    }

    
    public function getConn()
    {
        
        try{
            $result = $this->_DBconn();
            return $result;
            
        }catch(Exception $ex){
            
             throw new $ex;
        }
        
    }
    
}