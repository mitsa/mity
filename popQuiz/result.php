<?php
if(isset($_GET['qn']))
{
$tq=$_GET['qn'];

}
?>
<html>
<head>
<title>Quiz</title>
<style>
body{background-image:url(examResult.jpg);}
#box{width:700px;margin:50px 400px;background:#fff000;padding:30px;font-size:20px;}
</style>
</head>
<body>
<div id="box">
<?php
$db=mysqli_connect("localhost","root","","popquiz");
$sql="SELECT `answer`,`correct` FROM `answer`INNER JOIN `questions`
ON `answer`.`qID`= `questions`.`qID`
ORDER BY `answerID` DESC LIMIT 0,$tq ";

$res=mysqli_query($db,$sql);
$right=0;
while($row= mysqli_fetch_assoc($res))
{
 if($row['answer']==$row['correct'])
   {
   $right++;
  
   }

}

$right=ceil(($right*100)/$tq);
if ($right<60)
{
echo "<h1>".$right."%"." not good!!</h1>";
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