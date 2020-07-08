<?php
/////////////////////////////////
/////////////////////////////////
session_start();
// Redirect For Valid User back to log-in page, prevents visiting this page without login
if(!isset($_SESSION['userdata']))
{
        header('location: index.php');
        exit();
}
////////////////////////////
$index = 0; // getting Shuffled Array, just for the first run
$msg1  =  NULL; // holds a message for the user to resume the test 
// creating object
include('UitilityClass.php');
$ObjUitilityClass =  new UitilityClass();

// a combination with its value set to NULL below prevents duplicate shuffle of the keys for the same test when there are errors
$Success_msg =  " ";

// continue where the subject left from
if(isset($_SESSION['userdata']) && !isset($_POST['submit']))
{
    extract($_SESSION['userdata']);
    $fullName   = $name.$age.$gender[0];
    $storedFile = "./Results/".$fullName.".csv";
    if (file_exists($storedFile)) 
    {
      $fileArray = FILE($storedFile);
      $lineCount = COUNT($fileArray);
      if($lineCount > 0)
      {
        $msg1 = "Welcome back ".$name.", "." number of tests completed by you = ".$lineCount." out of ".$ObjUitilityClass->count_test().". Don't worry, test resumes automatically."; 
        if($lineCount<$ObjUitilityClass->count_test()){
        $_SESSION['index'] = $index = (int)strtok($fileArray[$lineCount-1],',');
        $Success_msg =  "Status: Test resumed";
        }
        else
        {
          header('location: thanks.php');
          exit();
        }
      }
      }
}
  // for debugging
  //unset($_SESSION['index']);
  //////////////////////////////// 
  // Click Submit Button /////////
  if(isset($_POST['submit'])) 
  {
    //  take care of the errors  //
    $TestCount = $_POST['TestCount']; // retain current state of the test if error
    ///remove unwanted data in Array (track this if you add new functionality in future )//////
    unset($_POST['submit']);
    unset($_POST['TestCount']);
    
    ///////// display Errors /////////////
    $Error_msg =  $ObjUitilityClass->Errors_check(array_keys($_SESSION['my_shuffle_array']),array_keys($_POST));
    //////////////////////////////////////
    $Success_msg = NULL; 
    //// retain current state of shuffled array in UI as long as errors exist, required for UI because we don't want key shuffle again
    $my_shuffle_array = $_SESSION['my_shuffle_array'];
    $shuffle_seq      = $_SESSION['$shuffle_seq'];
     /*==== execute only when a sub-test is over and save the scores =====*/
    if(empty($Error_msg))
    {
        ///////////sorted array logic///////
        $SortedArray = $ObjUitilityClass->test_sort($shuffle_seq,$_POST);
        ////////// Store into CVC File /////        
        if($ObjUitilityClass->write_file($SortedArray,$_SESSION['userdata'],$TestCount,$ObjUitilityClass->count_test()))
        $Success_msg       =  "Status: successfully Writing File..";
        $_SESSION['index'] = $index = $TestCount+1;

        if ($_SESSION['index'] == $ObjUitilityClass->count_test()) // returns the total number of all sub-tests
        {
          header('location: thanks.php');
          exit();
        }
    }   
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>AB Test</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="my_radio_style.css">
<!-- <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/> -->
</head>
<body>
<!-- nav bar -->
<nav class="navbar navbar-light bg-dark justify-content-between text-uppercase animate__animated animate__fadeInDown">
<a style="color:white;">
      <!--php code  -->
<?php extract($_SESSION['userdata']);
echo '<i class="fa fa-user fa-1x" style="color: orange;"></i> &nbsp;<strong>'.$name.'</strong>
|
Age : <strong>'.$age.'</strong>
|
Gender : <strong>'.$gender.'</strong>';
?>
    <!-- end php code  -->
</a>
<a style="color:magenta"> <!--prints a message to inform the user to continue the remaining test-->
<?php echo $msg1; ?>
</a>

<form class="form-inline">
<a href="logout.php" class="btn btn-outline-success my-2 my-sm-0"><i class="fa fa-sign-out" style="color: orange;"></i> Logout</a>
</form>
</nav>
<!--  stop nav -->
<!-- display msg -->
<?php  include('display_msg.php');   ?><!-- msg end -->

<!-- container start -->
<div class="container-fluid">
  <!-- row first -->
  <div class="row">

    <!-- col 8 -->
    <div class="col-sm-7">
<!-- *************************************************************************** -->
      <form action="#", method="post">
        <!-- table responsive -->
        <div class="table-responsive animate__animated animate__fadeInLeft"> <!-- responsive table is for mobile view-->
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Pannel</th>
                <th scope="col">Wavefile</th>
                <th scope="col">Rating...</th>
              </tr>
            </thead>
  <tbody>
<!-- fetch data -->
<?php  
$test = (!isset($_SESSION['index'])) ? $index : $_SESSION['index'];
if (isset($Success_msg))
//$_SESSION['my_shuffle_array'] = $my_shuffle_array = $ObjUitilityClass->random_array($test);
$_SESSION['$shuffle_seq']     = $shuffle_seq      = $ObjUitilityClass->test_shuffle_sequence($test);
$_SESSION['my_shuffle_array'] = $my_shuffle_array = $ObjUitilityClass->test_shuffle($test,$shuffle_seq);
// loop to display the wavefiles
$i = 1; // displays the panel number   
  //var_dump($my_shuffle_array);
foreach ($my_shuffle_array as $key => $value)
{
?>
<!--  -->
    <tr>       
      <th class="align-middle" scope="row">
        <!-- <i class="fa fa-arrow-right" style="color: orange;"></i> -->
         <span class="badge badge-danger"><?php echo $i;$i=$i+1; ?></span>
      </th>
      <td class="align-middle">
  <audio id="myAudio<?php echo $key; ?>">
    <source src="<?php echo $value;?>" type="audio/mpeg">
    Your browser does not support the audio element.
  </audio>
  <button onclick="playAudio<?php echo $key; ?>()" id="playbtn<?php echo $key; ?>" type="button" class="btn btn-outline-secondary">Play Audio</button>
  <!-- implements the beahaviour of the play buttons -->
  <script>
  function playAudio<?php echo $key; ?>() // for every button the function name is different given by  $key
  { 
    var x = document.getElementById("myAudio<?php echo $key; ?>");
    x.play();
    var y1; // controls cheating: user can not give score without listening to the wavefile
    x.onplaying = function() {
    y1 = null;
    document.getElementById("myAudio<?php echo $key;?>").value = y1; 
    var elems = document.getElementsByClassName("btn btn-outline-secondary"); // disable the play buttons while playing
    for(var i = 0; i < elems.length; i++) {
      elems[i].disabled = true;
    }
  }
      x.onpause = function() { 
      y1 = 1;
      document.getElementById("myAudio<?php echo $key;?>").value = y1; 
      var elems = document.getElementsByClassName("btn btn-outline-secondary");
      for(var i = 0; i < elems.length; i++) {
          elems[i].disabled = false;
      }
    }
  } 
  // well this function is not required any more, since I have implemented enable/disable play buttons
  // function pauseAudio<?php echo $key; ?>() { 
  //   var x = document.getElementById("myAudio<?php echo $key; ?>");  
  //   x.pause();
  //   y1 = null;
  //   document.getElementById("myAudio<?php echo $key;?>").value = y1; 
  //   document.getElementById("playbtn<?php echo $key; ?>").setAttribute('onclick','playAudio<?php echo $key; ?>()');
  // } 
  </script>
      </td>
        <td class="align-middle">
          <!-- desplay radio button -->
          <?php
          $h=1;// gives different function names when a radio button is selected 
          for ($x=1; $x<=5; $x++) // create radio buttons against play button dynamically
            { ?> <!-- change here to create a different scale-->

    <!-- ///////////////////////////////////////////////// -->
    <div class="form-check-inline">
    <label class="container">
                <?php
                // retain already given/checked scores if errors
                $check = NULL;             
                  if(!empty($Error_msg)) // switch to unchecked radio when a new test comes and all the files have been scored in previous sub-test
                  { 
                    if(array_key_exists($key, $_POST))
                    {
                      if ($_POST[$key] == $x)
                      {
                        $check = 'checked=""';
                      }
                      else
                      {
                        $check = " ";
                      }
                    }
                  }
                  ?>
  <input <?Php echo $check; ?> id="radiocheck<?php echo $h.$key; ?>" onclick="checkis<?php echo $h.$key; ?>()"class="form-check-input" value="<?php echo $x; ?>" type="radio"  name="<?php echo $key;?>">
   <script type="text/javascript">
// this function takes care of the case when user wants to cheet by giving scores without listening to the wavefiles (TODO: if a panel is missed, an error occurs, if the user wants to change the scores of previously heared wavefiles, he/she can not do it unless user listen to the wavefiles once again, since the values of variables z1 and z2 are destroyed when the page reloads)
  function checkis<?php echo $h.$key; ?>()
    {
      var z1 = document.getElementById("myAudio<?php echo $key;?>").value;
      if (z1!=null){
        document.getElementById("radiocheck<?php echo $h.$key; ?>").checked = true;
      }
      else {
            alert("Listen to a wavefile carefully till its end, then give your score.");
            document.getElementById("radiocheck<?php echo $h.$key; ?>").checked = false;
      }
    }
  </script>
  <span class="checkmark"></span> <!--for the look of radio button-->
    </label><?php echo $x; ?>
    </div>
    <!-- ///////////////////////////////////////////////// -->
                  <?php $h++;} ?>
    <!-- stop display radio button -->
          </td>
        </tr>
<!-- end of fetch data -->
<?php } ?>
    </tbody>
  </table>
</div>
<!-- end table data -->
  <div class="text-center">
  <!-- icon tag -->
  <!-- <i class="fa fa-cog fa-spin fa-1x fa-fw"></i> -->
  <?php echo "Test Count : <strong>".$test."</strong> / ".$ObjUitilityClass->count_test(); ?>
  <!--  -->
  <input hidden="" type="number" name="TestCount" value="<?php echo $status = (!isset($_SESSION['index'])) ? $index : $_SESSION['index']; ?>"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <!-- submit botton -->
  <input class=" btn btn-outline-success " type="submit" name="submit" value="Submit">
  <!-- stop submit button -->
  </div>
</form>
<!-- *************************************************************************** -->
</div>
<!-- stop col 8 -->
<!-- col 4 -->
<div class="col-sm-5 animate__animated animate__fadeInDown" style="border-radius: 0px;margin-top: 5px;"> 
  <!-- <div class="alert alert-success" role="alert" > -->
  <div class="alert alert-secondary" role="alert">  
    <center>
  <h4 class="alert-heading">Instructions</h4>
</center>
  <p>
    Rating scale:
  </p>
  <p style="text-align: left">
  <b>1: Bad:</b> Very annoying artifacts and/or very bad resynthesis quality<br>
  <b>2: Poor:</b> Annoying artifacts and/or bad resynthesis quality<br>
  <b>3: Fair:</b> Some artifacts and/or good synthesis quality<br>
  <b>4: Good:</b> Very few artifacts and/or very good resynthesis quality<br>
  <b>5: Excellent:</b> No artifacts, almost close to a natural speech<br>
</p>
  <ul>
      <li>On your left, each pannel has a wavefile which you will listen by clicking on the button.</li>
      <li>The goal is to evaluate the perceptual sound quality of various speech recordings.</li>
      <li>Preferably use high quality hedphones for this test.</li>
      <li>You will listen to the speech recordings along with the benchmark recording which is hidden and
      appear in random order.</li>
      <li>You will rate the perceptual sound quality taking into account any artifacts and the overall quality.</li>
     <li>The wavefiles on each pannel are presented in random order in each trial. For example, a wavefile at pannel-1 need not correspond to the same throught.</li>
    <li> Listen to a wavefile patiently till its end.</li>
    <li>You may repeatedly listen to a speech file.</li>
    <li> The test resumes automatically if interrupted, you need to supply the same login details. Please make a note of your login details.</li>
  </ul>

  <hr>
  <p class="mb-0">For any query, email me at jkdiith@gmail.com</p>
</div>
</div>
<!-- stop col 4  -->
</div>
<!-- stop row first -->
</div>		
<!-- Stop conatiner -->
</body>
</html>