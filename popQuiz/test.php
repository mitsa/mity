<?php

?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css">
<title>Register Test </title>
</head>
<body>

<fieldset>
<form action="test.php" method="post">

test name:<input type="text" name="testName" > <br>
total questions:<input type="text" name="totalQ" > <br>
Description:<textarea name="desc"> Explain about test , teacher , time test.... </textarea> <br>
Exam time:<input type="text" name="examtime" > (By minut) <br>
<input  type="submit" value="Send" >
</form>
</fieldset>

</body>
</html>


<?php
$db=mysqli_connect("localhost","root","","popquiz");

if(isset($_POST['testName']))
{

$testName=$_POST['testName'];
$totalQ= $_POST['totalQ'];
$desc=$_POST['desc'];
$examtime=$_POST['examtime'];
$sql="INSERT INTO `abouttest`(`testName`, `description`, `totalQuestion`,`examTime`) VALUES ('$testName', '$desc',$totalQ,$examtime)";
mysqli_query($db,$sql);

$query = "SELECT LAST_INSERT_ID() AS `id` FROM `abouttest` ";
$result = mysqli_query($db,$query);
$row= mysqli_fetch_assoc($result);
$lastTsetId = $row["id"];
echo $lastTsetId;

header("Location:makeQuestion.php?testId='$lastTsetId'");
}


?>