<?php 
$message = NULL;
if (isset($_POST['userdata'])){
extract($_POST);
//print_r($_POST);
if (empty($name)){
  $message = "Please fill your name!";
}
if (empty($age)){
  $message = "Please fill your age (must be a number)!";
}
if (empty($gender)){
  $message = "Please select your gender!";
}
if (empty($message)){
session_start();
$_SESSION['userdata'] = $_POST;
header('location: /mosTest/handle_formV3.php');
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <?php if(!empty($message)) {
  ?>
  <script type="text/javascript">
  alert("<?php echo $message; ?>");
</script>
<?php } ?>
</head>
<body>
<div class="container-fluid text-center">
  <h1>Please enter your details</h1>
  <div class="row">
    <div class="col-sm-4" style="background-color:lavender;"></div>
    <div class="col-sm-4" style="background-color:orange;"> 
      <!-- start form -->
                 <form action="#" method="post">
                  <div class="form-group">
                    <label for="email">Name:</label>
                    <input required="" value="<?php if(isset($name)) echo $name; ?>" name="name" type="text" class="form-control" placeholder="Name" id="name">
                  </div>

                  <div class="form-group">
                    <label for="pwd">Age:</label>
                    <input required=""  value="<?php if(isset($age)) echo $age; ?>" name="age" type="number" class="form-control" placeholder="Age" id="age">
                  </div>

                  <div class="form-group form-check">
                    <label class="form-check-label">
                      <input  required="" <?php if ((isset($gender)) && ($gender=='Male')) echo 'checked=""' ?> value="Male" class="form-check-input" type="radio" name="gender"> Male
                      <input  required="" <?php if ((isset($gender)) && ($gender=='Female')) echo 'checked=""' ?> class="form-check-input" type="radio" name="gender" value="Female"> Female
                    </label>
                  </div>
                  <button name="userdata" type="submit" class="btn btn-primary">Submit</button>
                </form> 
<!-- end  -->
  </div>
    <div class="col-sm-4" style="background-color:lavender;"></div>
  </div>
</div>
</div>
</body>
</html>