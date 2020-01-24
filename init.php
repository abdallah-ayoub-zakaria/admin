<?php
include 'connect.php';

$tpl    ='includes/templates/';
$css	='layout/css/';
$js		='layout/js/';
$fun 	='includes/function/';

include $fun.'function.php';
include $tpl.'header.php';

  if(!isset($nonavbar)){
  	include $tpl.'navbar.php';
    }
