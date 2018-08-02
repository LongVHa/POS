<?php include 'header.php'; ?>

<div class="col-md-12">
    <h2>Back Office</h2>
    
    <h3>To do List:</h3>
    
    <p>- Price medium and price large needs re-validating</p>
    <p>- Delete confirmation</p>
   
  
</div>
<br>
<hr>
<div class="container">
    <h2>Add</h2>
    <div class="col-lg-12">
          
        <?php 
        
        if(!empty($data['addStatus'])){
            
            //check if error msg
            if(array_key_exists('errMsg', $data['addStatus'] )){
               
             //output err msg array             
                foreach($data['addStatus']['errMsg'] as $errMsg){
                    echo '<div style="color:red">'. $errMsg . '</div>';
                }       
            
            //output last added item
            }else if(array_key_exists('lastInsert', $data['addStatus'] )){

                $inserted = $data['addStatus']['lastInsert'];
        ?>
        
            <div style="margin:10px 0;color:green;">
                <h2><i>Item Added</i></h2>
                 Number: <strong><?=$inserted[0]['number']; ?></strong> <br> 
                 Description: <strong><?=$inserted[0]['description']; ?></strong>  <br>
                 Price Medium: <strong><?=$inserted[0]['pmedium']; ?></strong> <br> 
                 Price Large: <strong><?=$inserted[0]['plarge']; ?></strong>  <br>
                 Section: <strong><?=$inserted[0]['section']; ?></strong>  
             </div> 
        
            <?php }
        }
        ?>
       
        <br>
        
        <form method="POST" action="backoffice">
            
            
            <label>Number: &nbsp; </label><input type="text" size="3" name="add['num']" placeholder="0"><br>
            <label>Description: &nbsp; </label><input type="text" size="45" name="add['desc']" placeholder="desc"><br>
            
            <label>Section:</label> 
            <label>Add New </label><input type="text" size="20" name="add['newSect']" placeholder="New Section"> Or

   
                <select name="add['selectSect']">
                    <option value="" selected hidden>Select existing</option>
                    
                    <?php 
                    //Add menu items
                    
                        foreach($data['sections'] as $section){   
                            
                           echo '<option " value=" ' . $section . ' ">' . $section . '</option>';             
                        }
                    ?>
                    
                </select>
  
            <br>
  
               
            <label>Price (medium): &nbsp; £</label><input type="text" size="10" name="add['prcm']" placeholder="0.00"><br>
            <label>Price (large): &nbsp; £</label><input type="text" size="10" name="add['prcl']" placeholder="0.00"><br>
            <br>
            <input type="submit" value="Submit">
            
        </form>
        
    </div>
</div>

<br>
<hr>
<div class="container">
    
    
    <?php
    //show deleted items
    if($data['delStatus']){
        
    $delItem = $data['delStatus'][0]; 

    ?>    
    
            <div style="margin:10px 0;color:red;">
                <h2><i>Item Deleted</i></h2>
                 Number: <strong><?=$delItem['number']; ?></strong> <br> 
                 Description: <strong><?=$delItem['description']; ?></strong>  <br>
                 Price Medium: <strong><?=$delItem['pmedium']; ?></strong> <br> 
                 Price Large: <strong><?=$delItem['plarge']; ?></strong>  <br>
                 Section: <strong><?=$delItem['section']; ?></strong>  
             </div> 
      
    <?php
    }
    ?>
    
    <h2>Menu</h2>   
    
        <div class="row">
            
            <div class="col-sm-1">No</div>
            <div class="col-sm-5">Desc</div>
            <div class="col-sm-1">Price Medium</div>
            <div class="col-sm-1">Price Large</div>
            <div class="col-sm-2">Section</div>
            <div class="col-sm-2"></div>
        
         </div>   
    
     <?php
    //update msg 
    if($data['updateStatus'])
    {
        $updated = $data['updateStatus'][0];
     
    ?>
      
            <div style="margin:10px 0;color:orange;">
                <h2><i>Item Updated</i></h2>
                 Number: <strong><?=$updated['number']; ?></strong> <br> 
                 Description: <strong><?=$updated['description']; ?></strong>  <br>
                 Price Medium: <strong><?=$updated['pmedium']; ?></strong> <br> 
                 Price Large: <strong><?=$updated['plarge']; ?></strong>  <br>
                 Section: <strong><?=$updated['section']; ?></strong>  
             </div> 
      
    <?php
    }
     
    //Get menu items  
     
    foreach($data['menu'] as $item){ 
        
        //check if EDIT button is choosen
        //display editable row
        if($item['id'] == $data['editId']){

    ?>
                
          <form method="POST" action="backoffice">
              <input type="hidden" name="update['id']" value="<?=$item['id']; ?>">
            <input type="text" name="update['number']" size="10" value="<?=$item['number']; ?>">
            <input type="text" name="update['desc']" size="50" value="<?=$item['description']; ?>">
            <input type="text" name="update['pmedium']" size="7" value="<?=$item['pmedium']; ?>">
            <input type="text" name="update['plarge']" size="7" value="<?=$item['plarge']; ?>">
            <input type="text" name="update['section']" size="18" value="<?=$item['section']; ?>">

            <input type="submit" value="Confirm"> <span style="display:inline-block;width:20px"></span>   
            <a href="./backoffice?cancel">Cancel</a>
            
          </form>
          
    <?php      
       
    }else{
              
      //display normal listing        
    ?>
    
    <div class="row menu-row"> 
        
        <div class="col-sm-1"><strong><?php echo $item['number']; ?></strong></div>     
        <div class="col-sm-5"><strong><?php echo $item['description']; ?></strong></div>
        <div class="col-sm-1"><strong>£<?php echo $item['pmedium']; ?></strong></div>
        <div class="col-sm-1"><strong>£<?php echo $item['plarge']; ?></strong></div>
        <div class="col-sm-2"><strong><?php echo $item['section']; ?></strong></div>
        
        <div class="col-sm-1"><a href="./backoffice?edit=<?php echo $item['id']; ?>">Edit</a></div>
        <div class="col-sm-1"><a href="./backoffice?delete=<?php echo $item['id']; ?>">Delete</a></div>
    </div>
    
    <?php 
    
       }
    
    }?>
    
</div>

<br><br><br>
<?php include_once 'footer.php'; ?>