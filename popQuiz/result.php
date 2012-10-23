<html>
<head>
<title>Quiz</title>
<style>
#box{width:700px;margin:50px 400px;background:#fff000;padding:30px;font-size:20px;}
</style>
</head>
<body>
<div id="box">
<?php
$db=mysqli_connect("localhost","root","","popquiz");
$sql="SELECT `answerID` , `answer`
FROM `answer`
INNER JOIN `questions` ON `answer`.`qID` = `questions`.`qID`
WHERE `questions`.`correct` = `answer`.`answer`
ORDER BY `answerID` DESC LIMIT 0,10 ";
$res=mysqli_query($db,$sql);
$right =mysqli_num_rows($res);
$right=$right*10;
if ($right<60)
{
echo $right."%"."<h1> Try again!!</h1>";
}
elseif($right<95)
{
echo $right."%"."<h1> Good!!</h1>";
}
else 
{
echo $right."%"."<h1> Well done</h1>";
}

?>
</div>
</body>
</html>