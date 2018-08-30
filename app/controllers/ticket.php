<?php

class Ticket extends Controller
{
    public function index()
    {
        //get all sections
        $allSections = $this->model('menu')->fetchSection();
        
        
        //if section button clicked
        if(isset($_POST['section'])){
 
            $section = $_POST['section'];
            $cookie_sect = $section;
            setcookie('section', $cookie_sect);
            
            //get sections items
            $result = $this->getSectionItems($section);
   
            $this->view('ticket', [                            
                                   'sectionItems' => $result,
                                   'allSections' => $allSections
                                  ]
             );
        }
        
        //display all sections
        $this->view('ticket', ['allSections' => $allSections]);    
        
    }
    
    protected function getSectionItems($section)
    {
        
        $result = $this->model('ticketMdl')->fetchBySection($section);
       
        return $result;
        
    }
    
}
