<?php

$this->model('pdoRun');

class Menu{
    
    private $pdoRun;
    
    public function __construct(){
        $this->pdoRun = new PdoRun();
    }
  
    //fetch all menu items
    public function fetchMenuItems()
    {
        
        $sql = 'SELECT * FROM menu';
      
        try{
          $result = $this->pdoRun->pdoSql($sql, 'pdoFetch', 0);
          return $result;

        } catch (Exception $ex) {
            throw new $ex('cannot load menu items');
        }
    }

    
    //fetch existing sections
    public function fetchSection()
    {

        $sql = 'SELECT section FROM menu';
        
        $result = $this->pdoRun->pdoSql($sql, 'pdoFetch', 0);
        
        $sectionArr = [];
        
        try{
            
            //push values into array
            foreach( $result as $key => $value){
              $sectionArr[] = trim($value[0],' ');
            }
           
           //remove duplicates
           return array_unique($sectionArr, SORT_REGULAR);
            
        } catch (Exception $ex) {
            throw new $ex;          
        }
    }

    //add new
    public function addNew($section, $number, $description, $pmedium, $plarge)
    {
        
        $sqlData = [
            'section'=>$section,
            'number'=>$number,
            'description'=>$description,
            'pmedium'=>$pmedium,
            'plarge'=>$plarge       
        ];
        
        $sql = "INSERT INTO menu(section, number, description, pmedium, plarge) VALUES(:section, :number, :description, :pmedium, :plarge)";  
        
        try{
            //insert new item
            $result = $this->pdoRun->pdoSql($sql, 'pdoModify', $sqlData);
            print_r($result);
            
            //fetch inserted
            if($result){
                
               $fetchByNum = $this->fetchByNum($number); 
               return $fetchByNum;
               
            }
   
        }catch(Exception $ex){
            
            throw new $ex;     
            
        }         
    }    
    
    //update items
    public function update($id, $section, $number, $description, $pmedium, $plarge)
    {
        
        $sql = 'UPDATE menu SET section=:section, number=:number, description=:description, pmedium=:pmedium, plarge=:plarge WHERE id=:id'; 
        $sqlUpdate = [
            'section' => $section,
            'number' => $number,
            'description' => $description,
            'pmedium' => $pmedium,
            'plarge' => $plarge,
            'id' => $id
        ];
        
        try{
             
           $result  = $this->pdoRun->pdoSql($sql, 'pdoModify', $sqlUpdate);
           return $result;
            
        }catch(Exception $ex){
            throw new $ex('Cannot update item!');
        }  
    }
    
    
    //delete items
    public function deleteItem($id)
    {
        
        $sql = "SELECT * FROM menu WHERE id=" .$id;
        $sqlDel = "DELETE FROM menu WHERE id=" .$id;
        
        $resultMsg = [];
      
        try{
            
            //check if id exist before delete          
            $result = $this->pdoRun->pdoSql($sql, 'pdoFetch', 0);
                  
            //delete if exists
            if($result = 1){
                
                //get single item details to return before deleting
                $resultMsg[] = $this->fetchById($id);

                //delete
                $this->pdoRun->pdoSql($sqlDel, 'pdoModify', [$id]);
    
                //output deleted item
                return $resultMsg[0];    
            }
        
        }catch(Exception $ex){
            throw new $ex;
        }             
    }
    
    //get single item details by id
    public function fetchById($id)
    {
        
        $sql = 'SELECT * FROM menu WHERE id=' . $id;
        
        try{
        
            $result = $this->pdoRun->pdoSql($sql, 'pdoFetch', 0);  
            return $result;
            
        }catch(Exception $ex){
            throw new $ex;
        }   
    }
   
    //fetch previous inserted item
    public function fetchByNum($itemNum)
    {
        $sql = 'SELECT * FROM menu WHERE number='. $itemNum;

        try{
 
             $result = $this->pdoRun->pdoSql($sql, 'pdoFetch', 0);
             return $result;

        }catch(Exception $ex){
             throw new $ex('Cannot fetch from DB');         
        }

    }
    
    
}

