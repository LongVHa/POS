<?php

class DBH{
    //connect to DB
    protected function DBconn()
    {

        $dbHost = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName = 'pos';

        //set DSN
        $dsn = 'mysql:host=' . $dbHost . ';dbname=' . $dbName;

        //create PDO instance
        $pdo = new PDO($dsn, $dbUsername, $dbPassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        
        return $pdo;
    }

    
}