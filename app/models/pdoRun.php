<?php

$this->model('DBH');

class PdoRun{
    
    private $pdo;
    
    public function __construct()
    {
           $dbh = new DBH();
           $this->pdo = $dbh->getConn();        
    }
    
    //PDO mode switcher
    public function pdoSql($sql, $req, $sqlData)
    {
        
        switch($req){
            
            case 'pdoExec':  
               $result = $this->_pdoExec($sql);
               return $result;
               break;
           
            case 'pdoFetch':
               $result = $this->_pdoFetch($sql);
               return $result;
               break;
           
            case 'pdoModify':
               $result = $this->_pdoModify($sql, $sqlData);
               return $result;
               break;        
        }       
    }
    
    //pdo execute
    private function _pdoExec($sql)
    {
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute();  
            return $result;           
   
    }
    
    //pdo with fetch
    private function _pdoFetch($sql)
    {              
            $stmt = $this->pdo->prepare($sql); 
            $stmt->execute();    
            $result = $stmt->fetchAll();
            return $result;   
    }
    
    
    //pdo modify   
    private function _pdoModify($sql, $sqlData){
        
            $stmt = $this->pdo->prepare($sql); 
            $result = $stmt->execute($sqlData);
            return $result;
        
    }
    
}
