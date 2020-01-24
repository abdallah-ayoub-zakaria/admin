<?php 
session_start();
if(isset($_SESSION['UserName'])){
	header('location:dashboard.php');
}
$nonavbar=' ';
$pageTitle="login ";
include 'init.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
	$UserName=$_POST['user'];
	$password=$_POST['pass'];

	$stmt=$con->prepare('SELECT UserID,UserName,Password FROM users WHERE UserName = ? AND Password= ? AND GroupID =1 ');
	$stmt->execute(array($UserName,$password));
	$row=$stmt->fetch();
	$count=$stmt->rowCount();
	if($count > 0){
		$_SESSION['UserName']=$UserName;
		$_SESSION['ID']=$row['UserID'];
		header('location: dashboard.php');
		exit();
	}
}


?>
<form class="login"  action ='<?php echo $_SERVER['PHP_SELF'] ?> ' method='POST'>
 <img src="layout/images/KcnonoAMi.png" alt="Our Clients">
	<input type="text" name="user" class="form-control" placeholder=" Enter your UserName" autocomplete="off">
	<input type="password" name="pass" class="form-control" placeholder="Enter your password" autocomplete="off">
	<input type="submit"  class="btn btn-primary btn-block" value="login">
</form>

<?php

include $tpl .'footer.php';
?>
