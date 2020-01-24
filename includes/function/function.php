<?php


///////////////////////////////////////////////////////////////////////////////////////////////
function getTitle(){
  
  global $pageTitle;
  if(isset($pageTitle)){

echo $pageTitle;

  }else{
  	echo "default";
  }


}
//////////////////////////////////////////////////////////////////////////////////////// 
function redirectHome($errorde,$url=null,$seconds=3){
	
	
	if($url===null){
		$url='index.php';
	}else
	{
		if(isset($_SERVER['HTTP_REFERER'])&& $_SERVER['HTTP_REFERER']!==''){
			$url=$_SERVER['HTTP_REFERER'];
		}else{
			$url='index.php';
		}
	}
	echo $errorde;
	echo "<div class=' alert alert-info'>You Will Be Redirected to Homepage after $seconds.</div>";
	header("refresh:$seconds;url= $url");
	exit();
}

/////////////////////////////////////////////////////////////////////////////////////////
function checkitem($select,$from,$value){
	GLOBAL $con;
	$stmtment=$con->prepare("SELECT $select FROM $from WHERE $select= ?");
	$stmtment->execute(array($value));
    $count=$stmtment->rowCount();
    return $count;
}
//////////////////////////////////////////////////////////////////////////////////
function countro($items,$tables){
	global $con;
	$stmts=$con->prepare("SELECT COUNT($items) FROM $tables");
	$stmts->execute();
	return $stmts->fetchColumn();

}//////////////////////////////////////lits///////////////////////

function getLatest($select,$table,$order,$limit=3){
	global $con;
	$stmts=$con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
	$stmts->execute();
	$row=$stmts->fetchAll();
	return $row;

}




?>