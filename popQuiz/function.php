<?php
function safeInsert($string)
{
global $db;
	$string = mysqli_real_escape_string($db, $string);
	$string = htmlentities($string);
	return $string;
}
?>