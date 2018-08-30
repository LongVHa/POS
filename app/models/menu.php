<?php

include_once('dbh.php');

class Menu extends DBH{
    

    //Fetch from DB proccess 
    public function fetchFromDB($sql)
    {
        
        $pdo = $this->DBconn();
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        
        return $results;
    }
    
    //fetch all menu items
    public function fetchMenuItems()
    {
        
        $sql = 'SELECT * FROM menu';
        
        $results = $this->fetchFromDB($sql);
        
        try{
          $menuItems = $results;  
          
          return $menuItems;

        } catch (Exception $ex) {
            throw new $ex('cannot load menu items');
        }
    }

    
    //fetch existing sections
    public function fetchSection()
    {

        $sql = 'SELECT section FROM menu';
        
        $results = $this->fetchFromDB($sql);
        
        $sectionArr = [];
        
        try{
            $section = $results;      
            
            //put values into array
            foreach( $section as $key => $value){
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

        $sql = "INSERT INTO menu(section, number, description, pmedium, plarge) VALUES(:section, :number, :description, :pmedium, :plarge)";
        $data = [
            'section'=>$section,
            'number'=>$number,
            'description'=>$description,
            'pmedium'=>$pmedium,
            'plarge'=>$plarge       
        ];
                
        try{
            
            $pdo = $this->DBconn();

            $stmt = $pdo->prepare($sql);
            $hasInserted = $stmt->execute($data);

            //if item has been added, fetch the new or last, insert
            if($hasInserted){
                
               $fetchByNum = $this->fetchByNum($number); 
               return $fetchByNum;
               
            }
   
        }catch(Exception $ex){
            throw new $ex;           
        }         
    }    
    
    public function update($id, $section, $number, $description, $pmedium, $plarge)
    {
        
        $sql = 'UPDATE menu SET section=:section, number=:number, description=:description, pmedium=:pmedium, plarge=:plarge WHERE id=:id'; 
        $data = [
            'section' => $section,
            'number' => $number,
            'description' => $description,
            'pmedium' => $pmedium,
            'plarge' => $plarge,
            'id' => $id
        ];
        
        try{
            $pdo = $this->DBconn();
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute($data);
            
            return $result;
            
        }catch(Exception $ex){
            throw new $ex('Cannot update item!');
        }  
    }
    
    public function deleteItem($id){
        
        $sqlDel = "DELETE FROM menu WHERE id=" .$id;
        $sqlCheck = "SELECT * FROM menu WHERE id=" .$id;
        
        $resultMsg = [];
      
        try{
            //check if id exist before delete
            $pdo = $this->DBconn();           
            $stmt = $pdo->prepare($sqlCheck);  
            $checkResult = $stmt->execute();
             
            //delete if exists
            if($checkResult = 1){
                
                //get single details to return before deteting
                $resultMsg[] = $this->fetchById($id);
                
                //delete
                $delStmt = $pdo->prepare($sqlDel);
                 $delStmt->execute(); 
                
                return $resultMsg[0];    
            }
        
        }catch(Exception $ex){
            throw new $ex;
        }             
    }
    
    //get single item details by id
    public function fetchById($id)
    {
        
        $sql = "SELECT * FROM menu WHERE id=" . $id;
        
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
   
    //fetch previous inserted item
    public function fetchByNum($number)
    {
        $sql = 'SELECT * FROM menu WHERE number='.$number;

        try{
            $pdo = $this->DBconn();
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            
            return $results;

        }catch(Exception $ex){
           throw new $ex('Cannot fetch from DB');         
        }

    }
    
    
}

