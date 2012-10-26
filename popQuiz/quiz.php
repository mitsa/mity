<?php
require_once("function.php");

if(isset($_GET['testId']))
{
$testId=(int)$_GET['testId'];

$testQ=(int)$_GET['TQ'];
}

$db=mysqli_connect("localhost","root","","popquiz");
$sql="SELECT `qID`,`question`,`option1`,`option2`,`option3`,`picture`,`correct` FROM `questions` WHERE `testID`='$testId' ";

$res=mysqli_query($db,$sql);

while($row =mysqli_fetch_assoc($res))
{


$num=$row['qID'];
$q=safeInsert($row['question']);
$option1=safeInsert($row['option1']);
$option2=safeInsert($row['option2']);
$option3=safeInsert($row['option3']);
$bild=$row['picture'];
?>

<html>
<head>
<title>Quiz</title>
<link rel="stylesheet" href="style.css" type="text/css">
<meta charset="UTF-8">
</head>
<body>
<form class="main" action="quiz.php" method="post">

<?php
//echo "<FIELDSET>";
if (strlen($bild) > 0  ) 
{
	echo "<img src='generateImage.php?id=$num' height='100' width='100'> <br>";
}


 echo "Question: ". $q ."<br>";
 echo "a)<input type='radio' name='a$num' value='a'>". $option1 . "<br>";
 echo "b)<input type='radio' name='a$num' value='b'>". $option2 . "<br>";
 echo "c)<input type='radio' name='a$num' value='c'>". $option3 ;
 echo  "<input type='hidden' name='tQ' value='$testQ'>";
 echo  "<input type='hidden' name='Qnum' value='$num'>";
 echo "<hr>";
// echo "</FIELDSET>";

}
?>
<input type='submit' name='send' value='send'>



</form>
</body>
</html>
<?php
if(isset($_POST['send']))
{
   $tq=(int)$_POST['tQ'];
   $Qnum=$_POST['Qnum'];
   
	   for ($i=$Qnum;$i>$Qnum-$tq;$i--)
			 {	 
			 
			 $ans=$_POST["a$i"];
			$sql="INSERT INTO answer(qID,answer)VALUES($i,'$ans')";
			echo $sql;
			echo $sql."<br>";
			mysqli_query($db,$sql);
			}
		header("Location:result.php?qn=$tq");	
			
	}
?>