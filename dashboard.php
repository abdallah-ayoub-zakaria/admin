<?php


session_start();
if(isset($_SESSION["UserName"])){
	$pageTitle="dashboard ";
	include 'init.php';
//start dashboard
  ?>
 
      <div class="container home-stats text-center">
     <h1 >Studant</h1>
     <div class="row">
      <div class="col-md-14">
        <div class="stat st-members"> 
      
        Total Members 
        <span><a href="members.php"><?php echo countro('UserID','users')?></a>
        </span>
        </div>
       
      </div>
    

 
     </div>
     </div>
    

    
  <?php
//end dashboard
//print_r($_SESSION);
    include $tpl .'footer.php'; 
}
else{
		header('location:index.php');
		exit;
}


