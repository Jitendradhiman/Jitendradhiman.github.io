<?php
session_start();
extract($_SESSION['userdata']);

$test = 1;
$msg  = NULL;


if (isset($_POST['submit'])) 
{
  extract($_POST);

          // logic for Errors !
          for ($x1=1; $x1<=$_SESSION['lines']; $x1++) 
          { $skey = $_SESSION['expSetkeys'];
            if (!array_key_exists($skey[$x1-1], $_POST))
            {
              $msg.= "Please score wavefile-".$x1."<br>";
              $test = $_POST['test'];
            }
          }
          ////////////////////////////////

  if (empty($msg))
  {
    //if(isset($_POST['test']))
      //{
        unset($test);
        $test = $_POST['test']+1;
        //function array_represent();
      //}
    print_r($_POST);
    echo "final good";
  }
}
// 
if($msg==NULL) 
{
  // 
      $idx = $test-1;
      $fileCont   = file_get_contents("MOSconfigure3.json");
      $file       = json_decode($fileCont,true);
      $allkeys    = array_keys($file);
      $_SESSION['lines'] = $lines      = COUNT($file[$allkeys[$idx]]);
      $_SESSION['expSet'] = $expSet     = $file[$allkeys[$idx]]; // audio data
      $_SESSION['expSetkeys'] = $expSetkeys = array_keys($expSet); // and the correspoding keys
      // shuffle all the keys for audio files
      shuffle($expSetkeys);
  // 
 
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
</head>
<body>

 <div class="alert alert-primary" role="alert">
  <?php
  // displays the error message if some of the wavefiles are not scored
  if (isset($_POST['submit'])) 
  {
    echo $msg;
   }

  ?>
</div> 
<div class="container-fluid">	
 <form action="#", method="post">  
 <table class="textcenter">
		<tr>
		<th>Wavefile</th>
    <th></th>
		</tr>
  <?php
   $expSet = $_SESSION['expSet'];
   //for ($i=1; $i<=$lines; $i++) { 
    foreach($_SESSION['expSetkeys'] as $key){
        $a = $expSet[$key];
        print_r($expSet[$key]);
   ?> 
   <tr>
    <td> 
      <?php //$expSet = $_SESSION['expSet']; echo $expSet[$key]; ?>
      <audio controls style="width: 240px;">
        <source src="<?php echo  $a;?>" type="audio/wav">
      </audio>


    </td>
	   <td>
        <?php for ($x=-3; $x<=3; $x++) { 
          ?>
          <div class="form-check-inline">
            <label class="form-check-label">
              
              <?php
              // retain already given/checked scores
              // $check =NULL;              
              // if(array_key_exists("panel".$i, $_POST))
              //   {
              //     $p = "panel".$i;
              //     if ($$p == $x) {
              //       $check = 'checked=""';
              //     }
              //   }
              ?>

              <input <?Php //echo $check; ?> class="form-check-input" value="<?php echo $x; ?>" type="radio"  name="<?php echo $key;?>"><?php echo $x; ?></label>
          </div>
        <?php } ?>
      </td>
		</tr>
  <?php } ?>
</table>
<br>
<div class="text-center">
  <input type="number" name="test"  value="<?php echo $test; ?>">
<input type="submit" name="submit" value="Submit">
<div>
</form>	
</div>		
</body>
</html>

