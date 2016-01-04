<meta charset="UTF-8">
<?php include 'header.php'; ?> 
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" type="text/css" href="css/forum.css" >

<style type="text/css">
#apDiv1 {
	position:absolute;
	top:122px;
	width:516px;
	height:93px;
	z-index:16;
	background-color: rgba(192,192,192,0.2);
	border-radius: 20px;
	left: 3px;
}
.notfound {
	background-color: #fff;
	position: absolute;
	left: 3px;
	top: 71px;
	width: 1216px;
	height: 60px;
	z-index: 100;
}
#apDiv2 {
	position:absolute;
	left:15px;
	top:16px;
	width:480px;
	height:62px;
	z-index:17;
	border-radius:20px;
}
.searchtext {
	position: absolute;
	border-width:3px;
	border-style: inset;
	background-color:#fff;
	left: 8px;
	font-size:15px;
	font-family:"Arial Black", Gadget, sans-serif;
	top: 15px;
	width: 319px;
	height: 33px;
}
.searchtext:focus{
	color:#000;
}
.searchbtton {
	position: absolute;
	left: 354px;
	top: 16px;
	width: 118px;
	background-color: #FC0;
	height: 33px;
	border-radius:20px;
	border-style:outset;
	border-width:3px;
	cursor:hand;
	font-weight: bold;
}
#newdiscuss
{
	border-width:4px;
	
	border-color:#999;
	cursor:hand;
}


</style>
</head>

<body >
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ( isset( $_POST['button'] ))
{

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "baaslk";
$tbl_name="fquestions"; 
$colorchange=0;
$bgcolor="";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$found =0;
$sql = "SELECT * FROM $tbl_name ORDER BY id DESC";;
$result = mysqli_query($conn, $sql);
$word =mysql_real_escape_string(stripslashes($_POST['textfield']));
$word = str_replace(' ','',$word);
?>
<div id="apDiv1">
<div id="apDiv2">
  <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <p>
      <label for="textfield"></label>
      <input name="textfield" type="text" class="searchtext" id="textfield" required>
      <input name="button" type="submit" class="searchbtton" id="button" value="SEARCH TOPIC">
  </p>
    <p>&nbsp;</p>
  </form>
</div>
</div>
<div class="createtabel">
<table border="0" bordercolor="#666666">
<tr>
<td>
<table width="1100" height="107" align="center" cellpadding="3" cellspacing="0" border="0" >
<tr >
<td colspan="7" align="center"><form method="post" action="new_topic.php"><input id="newdiscuss" type="submit" value="Add a new discussion topic"></form></td>
</tr>
<tr>
<td width="30%" align="center" bgcolor="#999"><strong>Discussion</strong></td>
<td width="30%" align="center" bgcolor="#999"><strong>Started by</strong></td>
<td width="15%" align="center" bgcolor="#999"><strong>Views</strong></td>
<td width="15%" align="center" bgcolor="#999"><strong>Replies</strong></td>
<td width="10%" align="center" bgcolor="#999"><strong>Date/Time</strong></td>
</tr>
<?php
if (mysqli_num_rows($result) > 0) {
while($rows = mysqli_fetch_assoc($result)) {
       $string = $rows["topic"];
	   $string = str_replace(' ','',$string);
	   $string = strtolower($string);
	   if(strpos($string,strtolower($word))>-1) 
	   {	$found++;
		   $colorchange=$colorchange+1;
	if($colorchange%2==1)
	{
		$bgcolor="#fff";
	}
	else
	{
		$bgcolor="#EEE";
	}
?>
<tr>
<td bgcolor="<?php echo $bgcolor?>" align="left" ><a href="view_topic.php?id=<?php echo $rows['id']; ?>"><strong><?php echo $rows['topic']; ?></strong></a><BR></td>
<td bgcolor="<?php echo $bgcolor?>">
<table align="center" border="0" width="100%" height="100%" bgcolor="<?php echo $bgcolor?>">
<tr>
<td align="center" bgcolor="<?php echo $bgcolor	?>" width ="50%" height="100%"><img src="<?php 
echo $rows['userphoto'];
?>" alt="" border=3 height=30 width=30></img></td>
<td align="left" bgcolor="<?php echo $bgcolor	?>" width ="50%" height="100%"><?php echo $rows['user'];?></td>
</tr>
</table>
</td>
<td align="center" bgcolor="<?php echo $bgcolor	?>"><?php echo $rows['view']; ?></td>
<td align="center" bgcolor="<?php echo $bgcolor	?>"><?php echo $rows['reply']; ?></td>
<td align="center" bgcolor="<?php echo $bgcolor	?>"><?php echo $rows['datetime']; ?></td>
</tr>
	
 <?php       		   
 }
		    

}
}
?>
</table>
</td>
</tr>
</table>

<?php

if($found == 0)
{
?>

<div class="notfound">
<table width="1077" bgcolor:"#fff">
<tr>
<td width="100%" align="center" bgcolor:"#fff"><p>&nbsp;</p>
  <p><strong>Not Founded</strong></p></td>
</tr>
</table>
</div>
<?php
}

mysqli_close($conn);

}
}
else{
 
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="baaslk"; // Database name 
$tbl_name="fquestions"; // Table name 
 
// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
 
$sql="SELECT * FROM $tbl_name ORDER BY id DESC";
// OREDER BY id DESC is order result by descending
 
$result=mysql_query($sql);
$colorchange=0;
$bgcolor="";
?>
<div class="createtabel">
<table border="0" bordercolor="#666666">
<tr>
<td>
<table width="1100" height="107" align="center" cellpadding="3" cellspacing="0" border="0" >
<tr >
<td colspan="7" align="center"><form method="post" action="new_topic.php"><input id="newdiscuss" type="submit" value="Add a new discussion topic"></form></td>
</tr>
<tr>
<td width="30%" align="center" bgcolor="#999"><strong>Discussion</strong></td>
<td width="30%" align="center" bgcolor="#999"><strong>Started by</strong></td>
<td width="15%" align="center" bgcolor="#999"><strong>Views</strong></td>
<td width="15%" align="center" bgcolor="#999"><strong>Replies</strong></td>
<td width="10%" align="center" bgcolor="#999"><strong>Date/Time</strong></td>
</tr>
 
<?php
 
// Start looping table row
while($rows = mysql_fetch_array($result)){
	$colorchange=$colorchange+1;
	if($colorchange%2==1)
	{
		$bgcolor="#fff";
	}
	else
	{
		$bgcolor="#EEE";}
?>
<tr>
<td bgcolor="<?php echo $bgcolor?>" align="left" ><a href="view_topic.php?id=<?php echo $rows['id']; ?>"><strong><?php echo $rows['topic']; ?></strong></a><BR></td>
<td bgcolor="<?php echo $bgcolor?>">
<table align="center" border="0" width="100%" height="100%" bgcolor="<?php echo $bgcolor?>">
<tr>
<td align="center" bgcolor="<?php echo $bgcolor	?>" width ="50%" height="100%"><img src="<?php 
echo $rows['userphoto'];
?>" alt="" border=1  height=30 width=30></img></td>
<td align="left" bgcolor="<?php echo $bgcolor	?>" width ="50%" height="100%"><?php echo $rows['user'];?></td>
</tr>
</table>
</td>
<td align="center" bgcolor="<?php echo $bgcolor	?>"><?php echo $rows['view']; ?></td>
<td align="center" bgcolor="<?php echo $bgcolor	?>"><?php echo $rows['reply']; ?></td>
<td align="center" bgcolor="<?php echo $bgcolor	?>"><?php echo $rows['datetime']; ?></td>
</tr>
 
<?php
// Exit looping and close connection 
}
mysql_close();
?>
</table>
</td>
</tr>
</table>
</div>
<div id="apDiv1">
<div id="apDiv2">
  <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <p>
      <label for="textfield"></label>
      <input name="textfield" type="text" class="searchtext" id="textfield" required>
      <input name="button" type="submit" class="searchbtton" id="button" value="SEARCH TOPIC">
  </p>
    <p>&nbsp;</p>
  </form>
</div>
</div>
<?php
}
?>

</body>