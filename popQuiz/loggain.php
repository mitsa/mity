<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>

<fieldset>
<legend><h1>Logg in</h1></legend>
<form method="post" action="loggain.php">
<p>Username:<input type="text" name="user"></p>
<p>Password:<input type="password" name="pass"></p>

<input type="submit" value="Skicka">
</form>
</fieldset>


</body>
</html>

<?php
if(isset($_POST['user']))
{
$db=mysqli_connect("localhost","root","","popquiz");

$user=$_POST['user'];
$user=mysqli_real_escape_string($db,$user);
$user=htmlentities($user);

$pass=$_POST['pass'];

$sql="SELECT `username`,`pass` FROM `loggin` WHERE `username`='$user'";
$res=mysqli_query($db,$sql);
if($row = mysqli_fetch_assoc($res))
{
$dbpass=$row['pass'];
$salt=substr($dbpass,0,64);
$passF=hash('sha256',$salt.$_POST['pass']);
$passalt=$salt.$passF;

	if($passalt==$dbpass)
		{
		session_start();
		$_SESSION['x']="$user";
		$_SESSION['y']="$pass";
		
		header("Location:test.php");
		 die();
		}
		else
		{
		 echo "Wrong Passwor!";
		}

}
else
{
echo "Wrong username";
}
}
?>