<?php include 'components/session-check.php' ?>
<?php
$user= $_SESSION['user_name'];
$sql = "SELECT * FROM users where user_name='$user'";
$result = mysqli_query($database,$sql) or die(mysqli_error($database)); 
$rws = mysqli_fetch_array($result);
$userphoto=$rws['user_avatar'];
$usercatagory=$rws['user_catagory'];
mysql_close();

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="baaslk"; // Database name 
$tbl_name="fanswer"; // Table name 
 
// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
 
// Get value of id that sent from hidden field 
$id=$_POST['id'];
 
// Find highest answer number. 
$sql="SELECT MAX(a_id) AS Maxa_id FROM $tbl_name WHERE question_id='$id'";
$result=mysql_query($sql);
$rows=mysql_fetch_array($result);
 
// add + 1 to highest answer number and keep it in variable name "$Max_id". if there no answer yet set it = 1 
if ($rows) {
$Max_id = $rows['Maxa_id']+1;
}
else {
$Max_id = 1;
}
 
// get values that sent from form 
$a_answer=$_POST['a_answer']; 
 
$datetime=date("d/m/y H:i:s"); // create date and time
 
// Insert answer 
$sql2="INSERT INTO $tbl_name(question_id, a_id,user,userphoto,a_answer, a_datetime,user_catagory)VALUES('$id', '$Max_id','$user', '$userphoto','$a_answer', '$datetime','$usercatagory')";
$result2=mysql_query($sql2);
 
if($result2){
// If added new answer, add value +1 in reply column 
$tbl_name2="fquestions";
$sql3="UPDATE $tbl_name2 SET reply='$Max_id' WHERE id='$id'";
$result3=mysql_query($sql3);
header('Location: forum.php');
   exit();
}
else {
echo "ERROR";
}
 
// Close connection
mysql_close();
?>