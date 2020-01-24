<?php

ob_start();
session_start();
$pageTitle="Member";
if(isset($_SESSION["UserName"])){
	
	include 'init.php';
$do=isset($_GET['do']) ? $_GET['do'] :'manage';



if($do=='manage'){


  $stmt=$con->prepare("SELECT * FROM users WHERE GroupID!=1 ");
  $stmt->execute();
  $rows=$stmt->fetchALL();
  ?>
  <h1 class="text-center"> Studant Members </h1>
  <div class="container ">
  <div class="table-responsive ">
   <table class="main-table text-center table table-bordered ">
     <tr>
       <td>#ID</td>
         <td>Username</td>
           <td>Email</td>
             <td>Full Name</td>
              
               <td>Date</td>
                 <td>Control</td>
                 </tr>


    
     <?php
foreach ($rows as $row ) {
    echo "<tr>";
echo "<td>" .$row['UserID']."</td>";
 
echo "<td>" .$row['UserName']."</td>";
  echo "<td>" .$row['email']."</td>";
echo "<td>" .$row['name']."</td>";

echo "<td>" .$row['data']."</td>";
  
echo "<td>  <a href='members.php?do=Edit&userid=".$row['UserID'] ."  ' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
                   <a href='members.php?do=Delete&userid=".$row['UserID'] ." ' class=' btn btn-danger      confirm'> <i class='fa fa-close'></i> Delete</a>";

       

                  echo "</td>";
  echo  "</tr>";
}

     ?>
 
</tr>
   </table> 

  </div>
    <a href ='members.php?do=Add' class="btn btn-primary"   ><i class="fa fa-plus"></i> New Member</a>
     
    </div>
<?php
}
/////////////////////////////////ADD MEMBER///////////////////////////////////////////
elseif ($do=='Add') {?>
   <h1 class="text-center"> Insert Members </h1>
  <div class="container">
  <form class="form-horizontal" action='?do=Insert' method="POST">

  <!--Start Username field-->
    <div class="form-group form-group-lg"> 

  <label class="col-sm-2 control-label">UserName</label>
  <div class="col-sm-10  col-md-4">
  <input type="text" name="username" class="form-control" placeholder="Enter your username"   autocomplete="off"  required ="required">
  </div>

    </div>  

     <!--End Username Field-->
       <!--Start Password field-->
    <div class="form-group form-group form-group-lg"> 

  <label class="col-sm-2 control-label">Password</label>
  <div class="col-sm-10  col-md-4">
  
  <input type="password" name="password" class="password form-control" placeholder="Enter your Password" autocomplete="new-password"  required ="required">
  
  </div>

    </div>  

     <!--End Password Field-->
       <!--Start Email field-->
    <div class="form-group form-group-lg"> 

  <label class="col-sm-2 control-label">Email</label>
  <div class="col-sm-10 col-md-4">
  <input type="email" name="email" class="form-control" placeholder="Enter your Email" autocomplete="off" required ="required">
  </div>

    </div>  

     <!--End Email Field-->
      <!--Start Email field-->
    <div class="form-group form-group-lg"> 

  <label class="col-sm-2 control-label">Full Name</label>
  <div class="col-sm-10  col-md-4">
  <input type="text" name="Full" class="form-control" placeholder="Enter your Full Name"  autocomplete="off" required ="required"  >
  </div>

    </div>  

     <!--End Email Field-->

       <!--Start Submit field-->
    <div class="form-group btn-lg"> 
  <div class="col-sm-offset-2 col-sm-10">
  <input type="submit" value ="add member" class="btn btn-primary " >
  </div>

    </div>  

     <!--End Submit Field-->
      
   </form>
  </div>



<?php
}
//////////////////////////////////INSERT MEMEBER//////////////////////////////////////////////
elseif ($do=='Insert') {
  
echo "<div class='container'>";

if($_SERVER['REQUEST_METHOD']=='POST'){
   echo "<h1 class='text-center'> Insert page</h1>";


   $id=$_POST['userid'];
   $user=$_POST['username'];
    $pass=$_POST['password'];
   $email=$_POST['email'];
   $full=$_POST['Full'];

$hashpass=sha1($_POST['password']);



$error= array();
if(strlen($user)<3){
  $error[]="<div class ='alert alert-danger'>username cant be <strong>less 4 characters</strong> </div>";
}
if(strlen($user)>20){
  $error[]="<div class ='alert alert-danger'>username cant be <strong>less 20 characters</strong></div>";
}

if(empty($user)){
  $error[]="<div class ='alert alert-danger'> <div class ='alert alert-danger'>username are <strong> empty</strong></div>";
}
if(empty($pass)){
  $error[]="<div class ='alert alert-danger'> <div class ='alert alert-danger'>password are <strong> empty</strong></div>";
}
 if(empty($email)){
  $error[]="<div class ='alert alert-danger'>email are <strong> empty</strong></div>";
}
 if(empty($full)){
  $error[]=" <div class ='alert alert-danger'>FullName are <strong> empty</strong></div>";
}

foreach ($error as $n) {
echo $n ;
}
if(empty($error)){
 
$check= checkitem('UserName','users',$user);
    if($check==1){
      $errorde= "<div class='alert alert-danger'>Sorry This User Is Exist</div>";
      redirectHome($errorde,'back');
    }else{
   $stmt=$con->prepare('INSERT INTO users( UserName,Password,email,name,Data) VALUES(:zuser ,:zpass,:zmail,:zname,now()) ');
   $stmt-> execute(array('zuser'=>$user,'zpass'=>$hashpass,'zmail'=>$email,'zname'=>$full));
    
    $errorde= "<div class ='alert alert-success'>" . $stmt->rowCount() . 'Record Insert </div>';
    redirectHome($errorde,'back');
}
}
}else{
  $errorde= "<div class='alert alert-danger'>Sorry You Cant Browse this page Directly</div>";
  redirectHome($errorde);
}
 
 echo "</div>";


}
////////////////////////EDIT MEMEBER///////////////////////////////////////////////////////////////////

elseif($do=='Edit'){

$userid=isset($_GET['userid']) && is_numeric($_GET['userid']) ?  intval($_GET['userid']) : 0;

$stmt=$con->prepare('SELECT * FROM users WHERE UserID= ?  LIMIT 1');
	$stmt->execute(array($userid));
	$row=$stmt->fetch(); 
	$count=$stmt->rowCount();
    if($stmt->rowCount()>0){?>
  
  <h1 class="text-center"> Edit Studant </h1>
  <div class="container">
  <form class="form-horizontal" action='?do=update' method="POST">
<input type="hidden" name="userid" value="<?php echo $userid ?>">
  <!--Start Username field-->
  	<div class="form-group form-group-lg"> 

	<label class="col-sm-2 control-label">UserName</label>
	<div class="col-sm-10  col-md-4">
	<input type="text" name="username" class="form-control" placeholder="Enter your username"  value="<?php echo $row['UserName']?>" autocomplete="off"  required ="required">
	</div>

  	</div>  

  	 <!--End Username Field-->
  	   <!--Start Password field-->
  	<div class="form-group form-group form-group-lg"> 

	<label class="col-sm-2 control-label">Password</label>
	<div class="col-sm-10  col-md-4">
	<input type="hidden" name="oldpassword" value="<?php echo $row['Password']?>" >
	<input type="password" name="newpassword" class="form-control" placeholder="Enter your Password" autocomplete="new-password">
	</div>

  	</div>  

  	 <!--End Password Field-->
  	   <!--Start Email field-->
  	<div class="form-group form-group-lg"> 

	<label class="col-sm-2 control-label">Email</label>
	<div class="col-sm-10 col-md-4">
	<input type="email" name="email" class="form-control" placeholder="Enter your Email" value="<?php echo $row['email']?>" autocomplete="off" required ="required">
	</div>

  	</div>  

  	 <!--End Email Field-->
  	  <!--Start Email field-->
  	<div class="form-group form-group-lg"> 

	<label class="col-sm-2 control-label">Full Name</label>
	<div class="col-sm-10  col-md-4">
	<input type="text" name="Full" class="form-control" placeholder="Enter your Full Name" value="<?php echo $row['name']?>" autocomplete="off" required ="required"  >
	</div>

  	</div>  

  	 <!--End Email Field-->
    
  	   <!--Start Submit field-->
  	<div class="form-group btn-lg"> 
	<div class="col-sm-offset-2 col-sm-10">
	<input type="submit" value ="save" class="btn btn-primary " >
	</div>

  	</div>  

  	 <!--End Submit Field-->
	</div>


 	 </form>


<?php
   }else{
      echo "<div class='container'>";
   $errorde= "<div class='alert alert-danger'>no therad id</div>";
    redirectHome($errorde);
    echo"</div>";
   }
}
//////////////////////////////UDAATE MEMEBER/////////////////////////////////////////////////
     	 elseif ($do=='update') {
   	echo "<h1 class='text-center'> Update page</h1>";


echo "<div class='container'>";

if($_SERVER['REQUEST_METHOD']=='POST'){
   
   $id=$_POST['userid'];
   $user=$_POST['username'];
   $email=$_POST['email'];
   $full=$_POST['Full'];
 
$pass='';
if(empty($_POST['newpassword'])){
	$pass=$_POST['oldpassword'];
}else{
	$pass=sha1($_POST['newpassword']);
}



$error= array();
if(strlen($user)<4){
  $error[]="<div class ='alert alert-danger'>username cant be <strong>less 4 characters</strong> </div>";
}
if(strlen($user)>20){
  $error[]="<div class ='alert alert-danger'>username cant be <strong>less 20 characters</strong></div>";
}

if(empty($user)){
  $error[]="<div class ='alert alert-danger'> <div class ='alert alert-danger'>username are <strong> empty</strong></div>";
}
 if(empty($email)){
  $error[]="<div class ='alert alert-danger'>email are <strong> empty</strong></div>";
}
 if(empty($full)){
  $error[]=" <div class ='alert alert-danger'>FullName are <strong> empty</strong></div>";
}

foreach ($error as $n) {
echo $n ;
}
if(empty($error)){
 

   $stmt=$con->prepare('UPDATE users SET UserName=?,Email=?,name=? ,Password=? WHERE UserID=? ');
   $stmt-> execute(array($user,$email,$full,$pass,$id));
    $errorde="<div class ='alert alert-success'>" . $stmt->rowCount() . 'Record update </div>';
     redirectHome($errorde,'back');
}

}else{
echo '<div class="container">';
	$errorde= "Sorry You Cant Browse this page Directly";
  redirectHome($errorde);
  echo '</div>';
}
 
 echo "</div>";
}

///////////////////////////DELETE MEMBER////////////////////////////////////////////////////////
elseif ($do=='Delete') {
 echo' <h1 class="text-center"> Delete Studant </h1>';
 echo ' <div class="container">';
  $userid=isset($_GET['userid']) && is_numeric($_GET['userid']) ?  intval($_GET['userid']) : 0;

$stmt=$con->prepare('SELECT * FROM users WHERE UserID= ?  LIMIT 1');
  $stmt->execute(array($userid));
  $count=$stmt->rowCount();
    if($stmt->rowCount()>0){
     $stmt=$con->prepare('DELETE FROM users WHERE UserID=:zuser');
     $stmt->bindparam('zuser',$userid);
     $stmt->execute();
     $errorde="<div class ='alert alert-success'>" . $stmt->rowCount() . 'Record Delete </div>';
redirectHome($errorde,'back' );

}
echo "</div>";
}

include $tpl .'footer.php'; 
}
else{
		header('location:index.php');
		exit;
}
ob_end_flush();
?>

