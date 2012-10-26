<?php
if(isset($_POST['user']))
{
	if(empty($_POST['user']))
		{ 
			echo "<h1>you forgot username</h1>";
		}
	elseif(empty($_POST['pass']))
	   { 
	     echo "<h1>you forgot password</h1>";
	   }
	else
	   {
			$db=mysqli_connect("localhost","root","","popquiz");

			$user=$_POST['user'];
			$user=mysqli_real_escape_string($db,$user);
			$user=htmlentities($user);

			$sql="SELECT`username` FROM `loggin` WHERE `username`='$user'";
			$res=mysqli_query($db,$sql);
			$finns=mysqli_num_rows($res);
			if($finns!=0)
				{
					echo "<h1>OBS!Användanamn finns,välja en till !!!</h1>";
				}
			else
				{
					$pass=$_POST['pass'];

					$slump=time()."d316f".$user;
					$salt=hash('sha256',$slump);

					$pass=hash('sha256',$salt.$pass);
					$pass=$salt.$pass;


					$sql="INSERT INTO `loggin`( `pass`, `username`) VALUES ('$pass','$user')";
					mysqli_query($db,$sql);
					echo "<h1>welcome  ".$user."You can <a href=loggain.php> log in here </a> </h1>  ";
				}
		}
}
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>

<fieldset>
<legend><h1>Register</h1></legend>
<form method="post" action="register.php">
<p>Username:<input type="text" name="user"></p>
<p>Password:<input type="password" name="pass"></p>

<input type="submit" value="Skicka">
</form>
</fieldset>


</body>
</html>