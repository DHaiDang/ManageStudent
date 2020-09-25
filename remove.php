<?php
	require 'config.php';

	if(isset($_GET['removeuser'])) {
		$errMsg = '';
		// Get username from FORM
		$usernameid = $_GET['usernameid'];

		if($usernameid == '')
			$errMsg = 'Enter username/ id to remove';

		if($errMsg == '') {
			try{
				$stmt = $connect->prepare('DELETE FROM student WHERE id = :id OR username = :username LIMIT 1');
				$stmt->execute(array(
					':id' => $usernameid,
					':username' => $usernameid
					));
				header("Location: dashboard.php");
				// $errMsg = 'User ' . $usernameid . ' successfully removed.';

			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
		}
	}
?>

<html>
<head>
	<title>Remove User</title>
	<link rel="icon" href="./img/murom.png"/>
</head>
	<style>
	html, body {
		margin: 1px;
		border: 0;
	}
	</style>
<body>
	<div align="center">
		<div style=" border: solid 1px #006D9C; " align="left">
			<?php
				if(isset($errMsg)){
					echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
				}
			?>
			<div style="background-color:#006D9C; color:#FFFFFF; padding:10px;"><b>Remove User</b></div>
			<div style="margin: 15px">
				<form action="" method="get">
				Enter Username / ID <br>
					<input type="text" name="usernameid" autocomplete="off" class="box"/><br /><br />
					<input type="submit" name='removeuser' value="Remove" class='submit'/><br />
				</form>
			</div>
		</div>
	</div>
</body>
</html>
