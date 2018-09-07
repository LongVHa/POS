<?php include_once 'header.php'; ?>


<h2>Ticket</h2>

<div id="tkt-wrapper" style="width:50%;margin:0 auto;height:80vh;">
    
    <div id="tkt-btn-container">
        
        <form action="ticket" method="POST">

            <?php 
            
            //main side section menus
            $sections = [];
            
            if($data['allSections']){
                foreach($data['allSections'] as $section){
                    $sections[] = $section;
                }
            }
    
            if(isset($sections)){
            
                foreach($sections as $sect)
                {
                ?>    
                    <button class="tkt-button" type="submit" name="section" value="<?=$sect; ?>"><?=$sect; ?> &#9656; </button>
                <?php
                }
            }
            ?>
   
        </form>

    </div>
    

    <div id="sect-item-container">
        
        <div class="menuItem">
             
                <?php 
                 
                    //display selected section's item
                    if(!empty($data['sectionItems'])){
                        
                    //retain item description after posting    
  
                        foreach($data['sectionItems'] as $item){
                        
                            setcookie('number', $item['number']);
                            setcookie('desc', $item['description']);
                            setcookie('pmedium', $item['pmedium']);
                            setcookie('plarge', $item['plarge']);
        
                ?>
                
                         <button class="menu-item-btn" onclick="addToTicket(this.value)" value="<?php echo $item['description']; ?>"> <?php echo $item['description']; ?> </button>
                            
                <?php
                        }
                    }
                    
                ?>
      
        </div>
        
    </div>
    
    
    <div id="tkt-roll-container">
        <div class="tkt-roll-item-wrap"></div>
    </div>
    
</div>

<?php include_once 'footer.php'; ?>