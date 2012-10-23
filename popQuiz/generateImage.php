<?php

require_once("function.php");

$dbConn=mysqli_connect("localhost","root","","popquiz");

$id =(int)$_GET['id'];

header("Content-type: image/jpeg");

$sql="SELECT `picture` FROM `questions` WHERE `qID`= $id ";
	$res=mysqli_query($dbConn,$sql);
	$row =mysqli_fetch_assoc($res);
	echo $row['picture'];

?>