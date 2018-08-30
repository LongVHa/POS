<?php 
include_once 'header.php'; 

if(!empty($data['signUpMsg'])){
    
     //output err msg array             
        foreach($data['signUpMsg'] as $signUpMsg){
            echo '<div class="'. $data['msgColor'] .'"><p>'. $signUpMsg . '</p></div>';
        }  
}

?>


    <h2>Sign Up</h2>

<section class="main-container">
    <div class="main-wrapper">
        <form action="signup" method="POST">
            <input type="text" name="first" placeholder="First Name">
            <input type="text" name="last" placeholder="Last Name">
            <input type="text" name="email" placeholder="E-mail">
            <input type="text" name="uid" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="submit">Sign Up</button>
        </form>
    </div>
</section>

    
<?php 
    include_once 'footer.php'; 
?>