<?php
	require 'config.php';
	if(empty($_SESSION['name']))
		header('Location: login.php');

	if(isset($_POST['update'])) {
		$errMsg = '';
		$username = $_SESSION['username'];
		$secretpin = $_POST['secretpin'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$password = $_POST['password'];
		$passwordVarify = $_POST['passwordVarify'];

		if($password != $passwordVarify) {
			$errMsg = 'Password not matched.';
			echo "<script>
			alert('Password does not match');
			window.location.href='dashboard.php';
			</script>";
		}
		if($errMsg == '') {
			try {
		      $sql = "UPDATE student SET password = :password,email = :email, phone = :phone, secretpin = :secretpin WHERE username = :username";
		      $stmt = $connect->prepare($sql);                                  
		      $stmt->execute(array(
						':password' => $password,
						':email' => $email,
						':phone' => $phone,
						':secretpin' => $secretpin,
						':username' => $username,
		      ));
				header('Location: update.php?action=updated');
				exit;
			}
			catch(PDOException $e) {
				echo "<script>
				alert('Something wrong, try again');
				window.location.href='dashboard.php';
				</script>";
			}
		}
	}

	if(isset($_GET['action']) && $_GET['action'] == 'updated'){
			// $stmt = $connect->prepare('SELECT id, password, secretpin, email, isAdmin,phone FROM student WHERE username = :username');
			// $stmt->execute(array(
			// 	':username' => $username
			// 	));
			// $data = $stmt->fetch(PDO::FETCH_ASSOC);
			// //session_destroy();
			// $_SESSION['id'] = $data['id'];
			// $_SESSION['password'] = $data['password'];
			// $_SESSION['email'] = $data['email'];
			// $_SESSION['phone'] = $data['phone'];
			// $_SESSION['secretpin'] = $data['secretpin'];
			// $_SESSION['isAdmin'] = $data['isAdmin'];
			// header('Location: dashboard.php');
			// exit;
		session_destroy();
		echo "<script>
			alert('Successfully updated. Please relogin.');
			window.location.href='dashboard.php';
			</script>";
		}
?>
<!-- 
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
			<form action="" method="post">
				Fullname <br>
				<input type="text" name="fullname" value="<?php echo $_SESSION['name']; ?>"disabled autocomplete="off" class="box"/><br /><br />
				Username <br>
				<input type="text" name="username" value="<?php echo $_SESSION['username']; ?>" disabled autocomplete="off" class="box"/><br /><br />
				Secret Pin <br>
				<input type="text" name="email" value="<?php echo $_SESSION['secretpin']; ?>" autocomplete="off" class="box"/><br /><br />
				Email<br>
				<input type="text" name="phone" value="<?php echo $_SESSION['email']; ?>" autocomplete="off" class="box"/><br /><br />
				Phone <br>
				<input type="text" name="secretpin" value="<?php echo $_SESSION['phone']; ?>" autocomplete="off" class="box"/><br /><br />
				Password <br>
				<input type="password" name="password" value="<?php echo $_SESSION['password'] ?>" class="box" /><br/><br />
				Vafify Password <br>
				<input type="password" name="passwordVarify" value="<?php echo $_SESSION['password'] ?>" class="box" /><br/><br />
				<input type="submit" name='update' value="Update" class='submit'/><br />
			</form>
		</div>
	</div>
</body>
</html> -->
