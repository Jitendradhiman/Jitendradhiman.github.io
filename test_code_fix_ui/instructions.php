<?php
session_start();
if(isset($_POST['submit1'])){
$_SESSION['audio'] = $_POST['audio'];
//print_r($_SESSION);
header('location: action.php');
exit();
}
?>
<!DOCTYPE html>
<html>
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
<body>
	<ul>
		<li>Now, you will be directed to the test page.</li>
		<li>You will be asked to listen to speech wavefiles which requires a headphone.</li>
		<li>It is preferable to use high a high-quality headphone for the test.</li>
		<li>Read the instructions carefully given on the test page before you begin with the test.</li>
	</ul>
	<form name = "form1"  action="" method="post">
	Plese select the device that you will be using for listening to the speech waveforms: <br>
	<div class="form-group form-check">
		<label class="form-check-input">
			<input  required="" <?php if ((isset($audio)) && ($audio=='E0')) echo 'checked = ""'?> type="radio" name="audio" value="E0"> Earphone
			&nbsp;&nbsp;&nbsp;
			<input  required="" <?php if ((isset($audio)) && ($audio=='H1')) echo 'checked = ""'?> type="radio" name="audio" value="H1"> Headphone
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input  required="" <?php if ((isset($audio)) && ($audio=='H2')) echo 'checked = ""'?> class="form-check-input" type="radio" name="audio" value="H2"> A Sennheiser headphone (HD 650)
	    </label>
	</div>
	<br>
	<input class= "btn btn-success" type="submit" name="submit1" value="Proceed">
    </form>
</body>
</html>