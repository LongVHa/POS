<?php

$this->model('dbh');

class TicketMdl extends DBH{
    
    
    //fetch Item by section  
    public function fetchBySection($section)
    {
        $sql = 'SELECT * FROM menu WHERE section="'.$section.'"';
        
        try{
            
            $pdo = $this->DBconn();
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
 
            return $result;
            
        }catch(Exception $ex){
              throw new $ex;
             
        }
        
    }

}
