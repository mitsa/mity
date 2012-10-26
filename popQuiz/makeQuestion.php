<?php 
if(isset($_GET['testId']))
{
$lastTsetId=$_GET['testId'];
$totaltQ=$_GET['total'];
$examN=$_GET['testName'];
$exTime=$_GET['exTime'];

}

?>
<html>
<head>
<title>Make Questions </title>
</head>
<body>

<form action="makeQuestion.php" method="post" enctype="multipart/form-data" >

Test Name: <?php echo $examN; ?> <br>
Total queston:<?php echo$totaltQ; ?><br>
Exam time:<?php echo $exTime; ?> <br>

<input type="hidden" name="total" value="<?php echo $totaltQ;?>" >

<?php 
 $total=$totaltQ;
 echo  $total;
for($i=1;$i<=$total;$i++) { ?>

	<fieldset>
		<input type="file" name="filen<?php echo $i; ?>"> <br> 

		Q<?php echo $i ?>)<input type="text" name="question[]" size="150"> <br>
		a)<input type="text" name="optionA<?php echo $i; ?>" size="150"> <br>
		b)<input type="text" name="optionB<?php echo $i; ?>" size="150"> <br>
		c)<input type="text" name="optionC<?php echo $i; ?>" size="150"> <br>
		Answer is:<input type="text" name="correct<?php echo $i; ?>" size="50"><br>
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
  
  $counter = 1;
  foreach ( $_POST['question'] as $q  => $queryText)
	{	
		echo "<hr>värde: $q .$queryText"  ;
		$opA=$_POST['optionA'.$counter];
		$opB=$_POST['optionB'.$counter];
		$opC=$_POST['optionC'.$counter];
		$right=$_POST['correct'.$counter];
		$testId=$_POST['testId'];
			if (checkImage($_FILES['filen']['tmp_name'].$counter) )
				{
					$img = file_get_contents($_FILES['filen']['tmp_name'].$counter);
					$img = mysqli_real_escape_string($dbConn, $img);	
				}
			else
				{
					$img="";
					//echo "flie is not picture";
				}

			$sql = "INSERT INTO `questions`(`question`, `option1`, `option2`, `option3`, `picture`, `correct`,`testID`)VALUES ('$queryText','$opA','$opB','$opC','$img','$right',$testId)";
				
			echo "<p>" . $sql . "</p>";	
				
				mysqli_query($dbConn, $sql);
				
				
	$counter++;
	}
header("Location:printscreen.php");
 }
 

function checkImage($file)
{
	$check = getimagesize($file);
	return $check;
}


?>
