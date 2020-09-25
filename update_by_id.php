<?php
	require 'config.php';
	if(empty($_SESSION['name']))
		header('Location: login.php');
?>
<?php
	$id = $_GET['id'];
	if(isset($_POST['update'])) {
		$errMsg = '';
		$username = $_POST['username'];
		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$secretpin = $_POST['secretpin'];
		$password = $_POST['password'];
		$passwordVarify = $_POST['passwordVarify'];

		if($password != $passwordVarify)
			$errMsg = 'Password not matched.';

		if($errMsg == '') {
			try {
		      $sql = "UPDATE student SET username =:username, fullname = :fullname,email= :email, phone=:phone, password = :password, secretpin = :secretpin WHERE id =".$id;
		      $stmt = $connect->prepare($sql);                                  
		      $stmt->execute(array(
						':username' => $username,
						':fullname' => $fullname,
						':email' => $email,
						':phone' => $phone,
		        ':secretpin' => $secretpin,
		        ':password' => $password,
		      ));
				header('Location: update_by_id.php?action=updated');
				exit;
			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
		}
	}

	if(isset($_GET['action']) && $_GET['action'] == 'updated')
		echo "<script>
		alert('Successfully updated. Please relogin.');
		window.location.href='dashboard.php';
		</script>";
?>

<html>
<head>
	<link rel="icon" href="./img/murom.png"/>	
	<title>Update</title>
</head>
	<style>
	html, body {
		margin: 1px;
		border: 0;
	}
	</style>
<body>
	<div align="center">
		<?php
			if(isset($errMsg)){
				echo '<div>'.$errMsg.'</div>';
			}
		?>
		<div>
			<?php
				try {
					$stmt = $connect->prepare('SELECT id, fullname, username, password, secretpin, email, isAdmin,phone FROM student WHERE id='.$id);
					$stmt->execute(array(
						':username' => $username
						));
					$data = $stmt->fetch(PDO::FETCH_ASSOC);
				}
				catch(PDOException $e) {
					$errMsg = $e->getMessage();
				}
			?>
			<p>Change Infomation for : <?php echo($data['fullname'])?></p>
			<form class='form1' action="" method="post">
				Fullname <br>
				<input type="text" name="fullname" value="<?php echo $data['fullname']; ?>"/></br></br>
				Username <br>
				<input type="text" name="username" value="<?php echo $data['username']; ?>" /></br></br>
				Email <br>
				<input type="text" name="email" value="<?php echo $data['email']; ?>" /></br></br>
				Phone<br>
				<input type="text" name="phone" value="<?php echo $data['phone']; ?>" /></br></br>
				Secretpin <br>
				<input type="text" name="secretpin" value="<?php echo $data['secretpin']; ?>" /></br></br>
				Password <br>
				<input type="password" name="password" value="<?php echo $data['password'] ?>"/></br></br>
				Vafify Password <br>
				<input type="password" name="passwordVarify" value="<?php echo $data['password'] ?>"/></br></br>
				<input type="submit" name='update' value="Update" class='submit'/><br />
			</form>
		</div>
	</div>
</body>
</html>