<?php
session_start();

$username=$_SESSION['x'];
$password=$_SESSION['y'];


?>



<html>
<head>
<style>
fieldset{background:#ff5777;width:300px;}
</style>
</head>
<body>
<h1><?php echo $_SESSION['x'];?>'s account</h1>
<fieldset>
Username=<?php echo $username;?><hr>
password=<?php echo $password;?>
</fieldset>


</body>
</html>

<?php
//$_SESSION=array();
//session_destroy();
?>