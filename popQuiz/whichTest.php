<?php
$db=mysqli_connect("localhost","root","","popquiz");
?>
<html>
<head>
<title> which test</title>
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body style="background-image:url(pop.jpg);">
<form action="whichTest.php" method="get">
<fieldset>
	<h1>Select a Quiz</h1>

	<select name="test">
	<?php testName(); ?>
	</select>

	<input type="submit" value="Info" name="Info">

</form>
<?php

if(isset($_GET['Info']))
{
$testid=$_GET['test'];
$query = "SELECT `testName`,`totalQuestion`,`examTime`,`description` FROM `abouttest` WHERE `testID`=$testid";
	$result = mysqli_query($db,$query);
	$row= mysqli_fetch_assoc($result);
	
	$tname=$row['testName'];
	$TotalQue=$row['totalQuestion'];
	
	//echo "<fieldset>";
	echo "<p>Test name: $tname <br>" ;
	echo "Total Question:$TotalQue <br>";
	echo "Exam Time:".$row['examTime']."minute"."<br>" ;
	echo "About test:".$row['description']."<br>";
	
	echo" Take <a href='quiz.php?testId=$testid&TQ=$TotalQue'> $tname </a> exame </p>";
	echo "</fieldset>";
	
	
}

?>

</body>
</html>

<?php
function testName()
{
	global $db;
	$query = "SELECT `testID`,`testName` FROM `abouttest`";
	$result = mysqli_query($db,$query);
		while($row= mysqli_fetch_assoc($result))
		{
			 $tId= $row["testID"];
			 $tname= $row["testName"];
			 echo "<option value='$tId'>$tname </option>";
		}
}



?>