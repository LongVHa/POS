<?php

class Backoffice extends Controller
{
    
    public function index()
   {    
        //fetch model
        $menu = $this->model('menu');
        
        //returned value of add/delete function
        $addStatus = [];
        $delStatus = [];
        $updateStatus = [];
        $editId = 0;
        
         //ADD new
        if(isset($_POST['add']))
        {        
            $addStatus = $this->add();      
        }
      
        //EDIT ITEM
        if(isset($_GET['edit']))
        {
            $editId =  $_GET['edit'];            
        }
        
        
        //UPDATE
        if(isset($_POST['update']))
        {   
            
            $update = $_POST['update'];
            
            $id = trim($update["'id'"],' ');
            $section = trim($update["'section'"],' ');
            $desc = trim($update["'desc'"],' ');
            $number = trim($update["'number'"],' ');
            $pmedium = trim($update["'pmedium'"],' ');
            $plarge = trim($update["'plarge'"],' ');

            $result = $menu->update($id, $section, $number, $desc, $pmedium, $plarge);
            
            if($result = 1)
            {
                $updateStatus = $menu->fetchById($id);
                
            }
    
        }
        
        //DELETE an item
        if(isset($_GET['delete']))
        { 
            $delStatus = $menu->deleteItem($_GET['delete']);
        }      
          
        //fetch All items from menu DB
        $menuResult = $menu->fetchMenuItems();
        
        //fetch only 'section' field from menu in DB
        $sectionResult = $menu->fetchSection();
        
        //output results to view
        $this->view('backoffice', [  
                                        'menu' => $menuResult, 
                                        'sections' => $sectionResult,
                                        'addStatus' => $addStatus,
                                        'delStatus' => $delStatus,
                                        'editId' => $editId,
                                        'updateStatus' => $updateStatus
                                  ]
        );
  
    }

   // add new item to DB
   private function add()
   {
 
             $addArr = $_POST['add'];

             $newSect = $addArr["'newSect'"];
             $selectSect = $addArr["'selectSect'"];
             $number = $addArr["'num'"];
             $desc = $addArr["'desc'"];
             $pmedium = $addArr["'prcm'"];
             $plarge = $addArr["'prcl'"];
             
             $section = '';
             $addNewStatus = [];
             
             //check validation status
             $validate = $this->validate($newSect, $selectSect, $number, $desc, $pmedium, $plarge);    
             
             // if contains errors
             if(!empty($validate)){ 
                 
                 $addNewStatus['errMsg'] = $validate; //send error msg
                 
             }else{    
             //add to DB and get last inserted
                 
                 //get data from one or the other section boxes 
                 if(!empty($newSect)){
                     $section = $newSect;
                 }else{
                     $section = $selectSect;
                 }
                 
                 //add item to DB and fetch last inserted
                 $addNewStatus['lastInsert'] = $this->model('menu')->addNew($section, $number, $desc, $pmedium, $plarge);              
             }
             
             return $addNewStatus;

   }
   
  
   public function validate($newSect, $selectSect, $number, $desc, $pmedium, $plarge)
   {
      
             $errMsg = [];
             
             /*check for empties*/
             
             //if number is empty
             if(empty($number))
             {               
                 $errMsg[] =  'Number is empty';       

             }
             
             //check for duplicate number  
             if(!empty($number))
             {  
                 $checkDup = $this->model('menu')->fetchByNum($number);
   
                 if(!empty($checkDup))
                 {
                     $errMsg[] = 'This number already exists';
                 }
             }
             
             //if description is empty    
             if(empty($desc))
             {             
                 $errMsg[] =  'Description is empty'; 
             }
             
             // if both sections is empty           
             if( empty($newSect) && empty($selectSect))
             {
                 $errMsg[] =  'Add a section';
             }
             
             //if either price is empty 
             if(empty($pmedium && $plarge))
             {        
                 $errMsg[] =  'Add a price';           
             }
             
             /*if both section is selected*/
             if(!empty($newSect) && !empty($selectSect)){
                 $errMsg[] = 'Select ONE section only';
             }
 
             return $errMsg;  
   }
 
 
}

