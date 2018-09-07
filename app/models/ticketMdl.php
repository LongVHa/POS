<?php

$this->model('dbh');

class TicketMdl{
    
    private $pdo;
    
    public function __construct(){
           $dbh = new DBH();
           $this->pdo = $dbh->getConn();
    }
    
    //fetch Item by section  
    public function fetchBySection($section)
    {
        $sql = 'SELECT * FROM menu WHERE section="'.$section.'"';
        
        try{
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
 
            return $result;
            
        }catch(PDOException $ex){
              throw new $ex;
             
        }
        
    }

}
