<?php 
session_start();

echo  $_SESSION['x'];

?>

<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>


<p> <a href="loggain.php">New test</a> </p>

<h1>hej då  <?php echo $_SESSION['x']; ?> </h1>


</body>
</html>
<?php 

$_SESSION = array(); 
	session_destroy();	 

?>