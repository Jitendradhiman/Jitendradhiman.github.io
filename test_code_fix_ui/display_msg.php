<!-- ---------------------------------- -->

<?php if(isset($Error_msg))
{
	?>
  	<div class="alert alert-danger text-center animate__animated animate__zoomIn">
   
   <strong><?php echo $Error_msg; ?></strong>
    	
    </div>

 <?php } ?>

<!-- ---------------------------------- -->


<!-- ---------------------------------- -->

<?php if(isset($Success_msg) && $Success_msg !== " ")
{
	?>
  	<div class="alert alert-success text-center animate__animated animate__zoomIn">
   
  <strong><i class="fa fa-check-circle " aria-hidden="true"></i><small> <?php echo $Success_msg; ?></small></strong>
    	
    </div>

 <?php } ?>

<!-- ---------------------------------- -->