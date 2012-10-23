<?php
require_once("function.php");
if(isset($_GET['testId']))
{
$testId=(int)$_GET['testId'];
echo $testId;
}

?>
<html>
<head>
<title>Quiz</title>
</head>
<body>
<form class="main" action="quiz.php" method="post">

<?php
$db=mysqli_connect("localhost","root","","popquiz");
$sql="SELECT `qID`,`question`,`option1`,`option2`,`option3`,`picture`,`correct`FROM `questions` WHERE `testID`='$testId' ";
echo $sql;
$res=mysqli_query($db,$sql);
echo mysqli_num_rows($res);
while($row =mysqli_fetch_assoc($res))
{
$num=$row['qID'];
$q=safeInsert($row['question']);
$option1=safeInsert($row['option1']);
$option2=safeInsert($row['option2']);
$option3=safeInsert($row['option3']);
$bild=$row['picture'];

echo "<FIELDSET>";
if (strlen($bild) > 0  ) 
{
	echo "<img src='generateImage.php?id=$num' height='100' width='100'>";
}


 echo "Q". $q ."<br>";
 echo "a)<input type='radio' name='a$num' value='a'>". $option1 . "<br>";
 echo "b)<input type='radio' name='a$num' value='b'>". $option2 . "<br>";
 echo "c)<input type='radio' name='a$num' value='c'>". $option3 ;
 echo "</FIELDSET>";

}
?>
<input type='submit' name='send' value='send'>

<?php
if(isset($_POST['send']))
 {
 for ($i=1; $i<$testId ;$i++)
 {
$qusID=$i;
$ans=$_POST["a$i"];
$sql="INSERT INTO answer(qID,answer)VALUES($qusID,'$ans')";
mysqli_query($db,$sql);
}
}
?>

</form>
</body>
</html>