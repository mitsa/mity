<?php 
if(isset($_GET['testId']))
{
$lastTsetId=$_GET['testId'];
echo $lastTsetId;
}

?>
<html>
<head>
<title>Make Questions </title>
</head>
<body>

<form action="makeQuestion.php" method="post" enctype="multipart/form-data" >

Test Name: <?php testName() ?> <br>
Total queston:<?php echo totalQuestion(); ?><br>
Exam time:<?php examTime(); ?> <br>



<?php 
 $total=totalQuestion();
 echo  $total;
for($i=1;$i<=$total;$i++) { ?>

	<fieldset>
		<input type="file" name="filen"> <br> 

		Q<?php echo $i ?>)<input type="text" name="question" size="150"> <br>
		a)<input type="text" name="optionA" size="150"> <br>
		b)<input type="text" name="optionB" size="150"> <br>
		c)<input type="text" name="optionC" size="150"> <br>
		Answer is:<input type="text" name="correct" size="50"><br>
		<input type="hidden" value="<?php echo $lastTsetId?>" name="testId">
	</fieldset>
	
<?php }; ?>

 <input type="submit" value="Send" name="send">
</form>
</body>
</html>

<?php
$dbConn = mysqli_connect("localhost", "root", "", "popquiz");
 if(isset($_POST['send']))
  {
    for($i=1;$i<=$total;$i++) 
	 {
  
		if (isset($_FILES['filen']))
		{
			if (checkImage($_FILES['filen']['tmp_name']) )
				{
					$img = file_get_contents($_FILES['filen']['tmp_name']);
					$img = mysqli_real_escape_string($dbConn, $img);
				}
				else
				{
					echo "flie is not picture";
					break;
				}
				
				$ques=$_POST['question'];
				$opA=$_POST['optionA'];
				$opB=$_POST['optionB'];
				$opC=$_POST['optionC'];
				$right=$_POST['correct'];
				$testId=$_POST['testId'];
				$sql = "INSERT INTO `questions`(`question`, `option1`, `option2`, `option3`, `picture`, `correct`,`testID`)VALUES ('$ques','$opA','$opB','$opC','$img','$right',$testId)";
				mysqli_query($dbConn, $sql);
				header("Location:printscreen.php");
				
		}
	
	}
 }

 

function examTime()
{
global $lastTsetId;
$db=mysqli_connect("localhost","root","","popquiz");
$sql="SELECT `examTime` FROM `abouttest` WHERE testID=$lastTsetId ";
$res=mysqli_query($db,$sql);
$row=mysqli_fetch_assoc($res);
$examtime=$row['examTime'];
echo $examtime;
}


function totalQuestion()
{
global $lastTsetId;
$db=mysqli_connect("localhost","root","","popquiz");
$sql="SELECT `totalQuestion` FROM `abouttest` WHERE testID=$lastTsetId";
$res=mysqli_query($db,$sql);
$row=mysqli_fetch_assoc($res);
$totalQ=$row['totalQuestion'];
return  $totalQ;
}

function testName()
{
global $lastTsetId;
$db=mysqli_connect("localhost","root","","popquiz");
$sql="SELECT `testName` FROM `abouttest` WHERE testID=$lastTsetId";
$res=mysqli_query($db,$sql);
$row=mysqli_fetch_assoc($res);
$testName=$row['testName'];
echo $testName;
}

function checkImage($file)
{
	$check = getimagesize($file);
	return $check;
}




?>
