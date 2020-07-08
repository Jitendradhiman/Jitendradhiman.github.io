<?php 
session_start();
// Redirect For Valid User back to log-in page
if(!isset($_SESSION['userdata']))
{
        header('location: index.php');
        exit();
}
//$msgthaks = NULL;
extract($_SESSION['userdata']);

//if (isset($_GET['ref']) && $_GET['ref'] == 'msg')
//{
    $msgthanks = 'The test has been taken with the following login details: 
                <hr>
                <ul>
                    <li>NAME : '.$name.'</li>
                    <li>AGE : '.$age.'</li>
                    <li>GENDER : '.$gender.'</li>
                </ul>';
//}
session_destroy();
////////////////////////////
?><!DOCTYPE html>
<html lang="en">
<head>
<title>MOS test</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


</head>
<body>
	<div class="container text-center" >
               <div class="alert alert-primary" style="color:black; background-color: skyblue;"> 
                   <h2>Thank you <?php echo $name?> for your time. </h2><hr>
               </div>
               
    
    <div class="row">
        <div class="col-sm-6 text-dark text-left">
                <?php echo $msgthanks; ?>
            </div>

        <!--  -->
      <div class="col-sm-6">
        A fresh test can be taken by modifying the login details.
            <br><hr>
          <a href="index.php">click here <a>

        </div>
        <!--  -->
    </div>
   
</div>
</body>
</html>