<?php
    if(!isset($_SESSION)){
     session_start();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
 
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">        
        
    <style>
      <?php include 'styles.css'; ?>      
    </style>

        <title>POS</title>
    </head>

    <body>

        <div id="main-title">POS System</div>

        <?php 
        
        if(isset($_SESSION['u_id'])){
            echo '<div class="msgColorGreen">You are logged in as <strong>' . $_SESSION['u_uid'] . '</strong></div>';
        }
        
        include 'nav.php'; 
        
        ?>
    