<?php include 'header.php'; ?> 
<style type="text/css">
.createtabel {
	position: absolute;
	left: 127px;
	top: 175px;
	width: 724px;
	height: 450px;
}
#apDiv11 {
	position:absolute;
	left:765px;
	top:333px;
	width:579px;
	height:284px;
	z-index:4;
}
.image {
	position: absolute;
	width: 457px;
	height: 238px;
	left: 114px;
	top: 44px;
}
#apDiv12 {
	position:absolute;
	left:914px;
	top:150px;
	width:379px;
	height:165px;
	z-index:5;
}
.image2 {
	position: absolute;
	left: 44px;
	width: 281px;
	top: 34px;
	height: 175px;
}
</style>
</head>

<body>

<?php
 
include "../_database/database.php";
$tbl_name="fquestions"; // Table name 

$id=$_GET['id'];
$sql="SELECT * FROM $tbl_name WHERE id='$id'";
$result=mysqli_query($database,$sql);
$rows=mysqli_fetch_array($result);
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div class="createtabel">
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCC" class="viewtopic3">
<td bgcolor="#ccc"><strong><?php echo $rows['topic']; ?></strong></td>
</tr>
<tr>
<td bgcolor="#ccc" align="left"><?php echo "by ".$rows['user']."  -    ".$rows['datetime']; ?></td>
</tr>  
<tr>
<td bgcolor="#F8F7F1" height="75%"> <p><?php echo $rows['detail']; ?></p>
  <p>&nbsp;</p></td>
</tr>

</table></td>
</tr>
</table>
<BR>
 
<?php
 // view discussion
$tbl_name2="fanswer"; // Switch to table "forum_answer"
$sql2="SELECT * FROM $tbl_name2 WHERE question_id='$id'";
$result2=mysqli_query($database,$sql2);
while($rows=mysqli_fetch_array($result2)){
?>
<table align="center" width="1000">
<tr>
<td>
<table width="95%" border="0"  align="right" cellpadding="0" cellspacing="1" bgcolor="#CCC" class="viewtopic3">
<td bgcolor="#ccc"><strong>RE :</strong></td>
</tr>
<tr>
<td bgcolor="#ccc" align="left"><?php echo "by ".$rows['user']."  -    ".$rows['a_datetime']; ?></td>
</tr>  
<tr>
<td bgcolor="#F8F7F1" height="75%"> <p><?php echo $rows['a_answer']; ?></p>
  <p>&nbsp;</p></td>
</tr>

</table></td>
</tr>
</table>
</td>
</tr>
</table><br>
  
<?php
}
 
$sql3="SELECT view FROM $tbl_name WHERE id='$id'";
$result3=mysqli_query($database,$sql3);
$rows=mysqli_fetch_array($result3);
$view=$rows['view'];
 
// if have no counter value set counter = 1
if(empty($view)){
$view=1;
$sql4="INSERT INTO $tbl_name(view) VALUES('$view') WHERE id='$id'";
$result4=mysqli_query($database,$sql4);
}
 
// count more value
$addview=$view+1;
$sql5="update $tbl_name set view='$addview' WHERE id='$id'";
$result5=mysqli_query($database,$sql5);
mysqli_close($database);
?>
 
</div>