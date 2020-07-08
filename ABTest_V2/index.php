<?php 
$message = NULL;

if (isset($_POST['userdata']))
{
      extract($_POST);
      if (empty($name)) // check if the field is missing
      {
        $message = "Please fill your name!";
      }
      if (empty($age))
      {
        $message = "Please fill your age (must be a number)!";
      }
      if (empty($gender))
      {
        $message = "Please select your gender!";
      }
      /* uncomment for email
      if (!filter_var($email, FILTER_VALIDATE_EMAIL))
      {
        $message = "Invalid email format";
      }
      */
      if (empty($message))
      {
        session_start();
        // creating object
        include('UitilityClass.php');
        $ObjUitilityClass =  new UitilityClass();
        
        // send mail when hosted on server then correct and test (uncomment for email)
       //$ObjUitilityClass->sendmail($email,$_POST);

        $_SESSION['userdata'] = $_POST;
        header('location: action.php'); 
        exit();
      }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>MOS test</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>

</head>
  <?php if(!empty($message)) {
  ?>
  <script type="text/javascript">
  alert("<?php echo $message; ?>");
</script>
<?php } ?>

<body>
<div class="container-fluid text-center text-uppercase">
  <h1>Please enter your details</h1>
  <br>
  Your details will not be shared with anyone.
  <div class="row">
    <div class="col-sm-4" style="background-color:lavender;"></div>
    <div class="col-sm-4 text-center" style="background-color:orange;padding: 20px;"> 
      <!-- start form -->
                 <form action="" method="post">
                  <div class="form-group">
                    <label for="name">Name:</label>
                    <input required="" value="<?php if(isset($name)) echo $name; ?>" name="name" type="text" class="form-control" placeholder="Name" id="name">
                  </div>
                  <div class="form-group">
                    <label for="age">Age:</label>
                    <input required=""  value="<?php if(isset($age)) echo $age; ?>" name="age" type="number" class="form-control" placeholder="Age" id="age">
                  </div>
                  <!-- email field (uncomment to have email in the form) -->

<!--              <div class="form-group">
                    <label for="email">Email:</label>
                    <input required="" value="<?php //if(isset($email)) echo $email; ?>" name="email" type="email" class="form-control" placeholder="email" id="email">
                  </div>
 -->
                   <!--  -->
                  <div class="form-group form-check">
                    <label class="form-check-label">
                      <input  required="" <?php if ((isset($gender)) && ($gender=='Male')) echo 'checked=""' ?> value="Male" class="form-check-input" type="radio" name="gender"> Male &nbsp;&nbsp;&nbsp;&nbsp;
                      <input  required="" <?php if ((isset($gender)) && ($gender=='Female')) echo 'checked=""' ?> class="form-check-input" type="radio" name="gender" value="Female"> Female
                    </label>
                  </div>
                   <input class="btn btn-success " type="submit" name="userdata" value="Login">
                </form> 
<!-- end  -->
  </div>
    <div class="col-sm-4" style="background-color:lavender;"></div>
  </div>
</div>
</div>
</body>
</html>