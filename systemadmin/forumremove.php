<?php include 'header.php'; ?> 
<link rel="stylesheet" type="text/css" href="/BAAS_LK/css/forum.css" >

<style type="text/css">
#apDiv1 {
	position:absolute;
	top:110px;
	width:589px;
	height:70px;
	z-index:16;
	background-color: #CCCCCC;
	border-radius: 20px;
	left: 0px;
}
#apDiv2 {
	position:absolute;
	left:3px;
	top:7px;
	width:576px;
	height:51px;
	z-index:17;
	background-color: #CCCCCC;
	border-radius:20px;
}
.searchtext {
	position: absolute;
	border-width:3px;
	border-style: inset;
	background-color:#000;
	left: 130px;
	font-size:16px;
	font-family:"Arial Black", Gadget, sans-serif;
	top: 6px;
	width: 319px;
	height: 33px;
}
.searchtext:focus{
	color:#FFF;
}
.searchbtton {
	position: absolute;
	left: 458px;
	top: 7px;
	width: 118px;
	background-color: #FC0;
	height: 27px;
	border-radius:20px;
	font-weight: bold;
}

.notfound {
	background-color: #f2f2f2;
	position: absolute;
	left: 78px;
	top: 244px;
	width: 1213px;
	height: 169px;
	z-index: 100;
}
</style>
<script type="text/javascript">  
function msg(){  
var v= confirm("Are u sure?");  
if(v==true){  
alert("ok");  
}  
else{  
alert("cancel");  
}  
  
}  
</script>
</head>

<body bgcolor="#f2f2f2">
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
      <input name="button" type="submit" class="searchbtton" id="button" value="SEARCH">
 <strong> SEARCH TOPIC</strong></p>
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
<td width="10%"  align="center" bgcolor="#999"><strong>Remove</strong></td>
<td width="25%"  align="center" bgcolor="#999"><strong>Discussion</strong></td>
<td width="25%"  align="center" bgcolor="#999"><strong>Started by</strong></td>
<td width="15%"  align="center" bgcolor="#999"><strong>Views</strong></td>
<td width="15%"  align="center" bgcolor="#999"><strong>Replies</strong></td>
<td width="10%"  align="center" bgcolor="#999"><strong>Date/Time</strong></td>
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
<td bgcolor="<?php echo $bgcolor?>" align="center"><a href= "remove.php?detail=<?php  echo "forum".",".$rows['id'];?>" onClick="msg()"><img src="images/rm.jpg" alt="" border=3 height=30 width=30></img></a></td>
<td bgcolor="<?php echo $bgcolor?>" align="left" ><a href="view_topic.php?id=<?php echo $rows['id']; ?>" target="_blank"><strong><?php echo $rows['topic']; ?></strong></a><BR></td>
<td bgcolor="<?php echo $bgcolor?>">
<table align="center" border="0" width="100%" height="100%" bgcolor="<?php echo $bgcolor?>">
<tr>
<td align="center" bgcolor="<?php echo $bgcolor	?>" width ="50%" height="100%"><img src="/BAAS_LK/<?php 
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
</div>

<?php

if($found == 0)
{
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div class="notfound">
<table width="1000" bgcolor:"#cccccc">
<tr>
<td width="100%" align="center" bgcolor:"#cccccc"><strong>Not Founded</strong></td>
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
<table >
<tr>
<td>
<table width="1100" height="107" align="center" cellpadding="3"  cellspacing="0"  >
<tr>
<td width="10%" align="center" bgcolor="#999"><strong>Remove</strong></td>
<td width="25%" align="center" bgcolor="#999"><strong>Discussion</strong></td>
<td width="25%" align="center" bgcolor="#999"><strong>Started by</strong></td>
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
<td bgcolor="<?php echo $bgcolor?>" align="center"><a href= "remove.php?detail=<?php  echo "forum".",".$rows['id'];?>" onClick="msg()"><img src="images/rm.jpg" alt="" border=3 height=30 width=30></img></a></td>
<td bgcolor="<?php echo $bgcolor?>" align="left" ><a href="view_topic.php?id=<?php echo $rows['id']; ?>" target="_blank" ><strong><?php echo $rows['topic']; ?></strong></a><BR></td>
<td bgcolor="<?php echo $bgcolor?>">
<table align="center" border="0" width="100%" height="100%" bgcolor="<?php echo $bgcolor?>">
<tr>
<td align="center" bgcolor="<?php echo $bgcolor	?>" width ="50%" height="100%"><img src="/BAAS_LK/<?php 
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
      <input name="button" type="submit" class="searchbtton" id="button" value="SEARCH">
  <strong> SEARCH TOPIC</strong></p>
    <p>&nbsp;</p>
  </form>
</div>
</div>
<?php
}
?>
</body>
