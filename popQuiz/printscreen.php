<?php 
session_start();

echo $_SESSION['x'];

?>
<html>
<body>
Test send!!!

<p> <a href="loggain.php">New test</a> </p>

<p> <a href="printscreen.php"> logga ut </a> </P>


</body>
</html>
<?php 

session_destroy();

?>