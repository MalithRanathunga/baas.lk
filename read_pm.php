<?php
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="css/chat.css" rel="stylesheet" title="Style" />
        <title>Message</title>
		<link href="css/header.css" rel="stylesheet">
		<style>
		h1,td,h2,label,input,th{
			font-family:'Fauna One',serif;
		}
		.date{
			font-family:'Fauna One',serif;
		}
		</style>
    </head>
    <body>
	<?php include ('header.php');
	mysql_connect('localhost', 'root', '');
	mysql_select_db('baaslk');
	?>
    	<div class="header">
        	<br /><br /><br /><br />
<?php
//We check if the user is logged
if(isset($_SESSION['username']))
{
	//We check if the ID of the discussion is defined
	
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		//We get the title and the narators of the discussion
		$req1 = mysql_query('select title, user1, user2 from pm where id="'.$id.'" and id2="1"');
		$dn1 = mysql_fetch_array($req1);
		
		//We check if the discussion exists
	
		if(mysql_num_rows($req1)==1)
		{
			//We check if the user have the right to read this discussion
			if($dn1['user1']==$_SESSION['userID'] or $dn1['user2']==$_SESSION['userID'])
			{
			//The discussion will be placed in read messages
				if($dn1['user1']==$_SESSION['userID'])
				{
					mysql_query('update pm set user1read="yes" where id="'.$id.'" and id2="1"');
					$user_partic = 2;
				}
				else
				{
					mysql_query('update pm set user2read="yes" where id="'.$id.'" and id2="1"');
					$user_partic = 1;
				}
			//We get the list of the messages
			$req2 = mysql_query('select pm.timestamp, pm.message, users.user_id as userid, users.user_name, users.user_avatar from pm, users where pm.id="'.$id.'" and users.user_id=pm.user1 order by pm.id2');
			//We check if the form has been sent
			
			if(isset($_POST['message']) and $_POST['message']!='')
			{
					$message = $_POST['message'];
					//We remove slashes depending on the configuration
					if(get_magic_quotes_gpc())
					{
						$message = stripslashes($message);
					}
					//We protect the variables
					$message = mysql_real_escape_string(nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8')));
					//We send the message and we change the status of the discussion to unread for the recipient
					
					if(mysql_query('insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "'.(intval(mysql_num_rows($req2))+1).'", "", "'.$_SESSION['userID'].'", "", "'.$message.'", "'.time().'", "", "")') and mysql_query('update pm set user'.$user_partic.'read="yes" where id="'.$id.'" and id2="1"'))
					{
				?>
				<div class="message"><?php echo THEMESSAGESENDSUCCESSFULLY ; ?>.<br /><br/><br/>
				<a href="read_pm.php?id=<?php echo $id; ?>"><?php echo GOTOTHEDISCUSSION ; ?></a></div>
				<?php
					}
					else
					{
						?>
						<div class="error">An error occurred while sending the message.<br /><br/>
						<a href="read_pm.php?id=<?php echo $id; ?>">Go to the discussion</a></div>
						<?php
					}
			}

			else
			{
			//We display the messages
			?>
			<div class="content">
			<h1><?php echo $dn1['title']; ?></h1><br/><br/>
			<table class="messages_table">
				<tr>
					<th class="author"><?php echo USER ; ?></th>
					<th><?php echo MESSAGE ; ?></th>
				</tr>
			<?php
			while($dn2 = mysql_fetch_array($req2))
			{
			?>
				<tr>
					<td class="author center"><?php
			if($dn2['user_avatar']!='')
			{
				echo '<img src="'.htmlentities($dn2['user_avatar']).'" alt="" style="max-width:50px;max-height:50px;" />';
			}
			?><br /><?php echo $dn2['user_name']; ?></td>
					<td class="left"><div class="date"><?php echo SENT ; ?>: <?php echo date('m/d/Y H:i:s' ,$dn2['timestamp']); ?></div>
					<?php echo $dn2['message']; ?></td>
				</tr>
			<?php
			}
			//We display the reply form
			?>
			</table><br /><br/>
			<h2 align="center"><?php echo REPLY ; ?></h2><br/><br/>
			<div class="center">
				<form action="read_pm.php?id=<?php echo $id; ?>" method="post">
					<label for="message" class="center"><?php echo MESSAGE ; ?></label><br />
					<textarea cols="40" rows="5" name="message" id="message"></textarea><br/><br/>
					<input type="submit" value="<?php echo SEND ; ?>" />
				</form>
			</div>
			</div>
			<?php
			}
			}
			else
			{
				echo '<div class="error">You dont have the rights to access this page.</div>';
			}
		}
		else
		{
			echo '<div class="error">This discussion does not exists.</div>';
		}
	}
	else
	{
		echo '<div class="error">The discussion ID is not defined.</div>';
	}
	}
else
{
	echo '<div class="error">You must be logged to access this page.</div>';
}
?>
		<div class="foot"><a href="list_pm.php"><?php echo GOTOMYPERSONALMESSAGES ; ?></a></div>
	</body>
</html>