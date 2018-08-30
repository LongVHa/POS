<?php 

    if(!empty($data['loginMsg'])){
     
        //output err message                   
        echo '<div class="'. $data['msgColor'] .'"><p>'. $data['loginMsg'][0] . '</p></div>';    
                
    }else if(!empty($data['logoutMsg'])){
        //show logged out message
        echo '<div class="'. $data['msgColor'] .'"><p>'. $data['logoutMsg'] . '</p></div>';        
    }

?>


<div class="nav-login">
   <?php 

   //is logged in, show logout button
        if(isset($_SESSION['u_id'])){
       
   ?>
    
    <form action="logout" method="POST">
       
        <button type="submit" name="logout" />Logout</button>
        
    </form>
    
   <?php
   }else{
   //show login form
   ?>   
    
    <form action="login" method="POST">
        
        <input type="text" name="uid" placeholder="Username">
        <input type="password" name="pwd" placeholder="password">
        
        <button type="submit" name="login">Login</button>
        
    </form>
    
   <?php      
   } 
   ?>
    
</div>
    <h3>To Do:</h3>    
- separate login form