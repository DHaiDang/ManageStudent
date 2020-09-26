<?php
	require 'config.php';

	if(isset($_POST['login'])) {
		$errMsg = '';

		$username = $_POST['username'];
		$password = $_POST['password'];

		if($username == '')
			$errMsg = 'Enter username';
		if($password == '')
			$errMsg = 'Enter password';

		if($errMsg == '') {
			try {
				$stmt = $connect->prepare('SELECT id, fullname, username, password, secretpin, email, isAdmin,phone FROM student WHERE username = :username');
				$stmt->execute(array(
					':username' => $username
					));
				$data = $stmt->fetch(PDO::FETCH_ASSOC);

				if($data == false){
					$errMsg = "User $username not found.";
				}
				else {
					if(md5($password) == $data['password']) {
						$_SESSION['id'] = $data['id'];
						$_SESSION['name'] = $data['fullname'];
						$_SESSION['username'] = $data['username'];
						$_SESSION['password'] = md5($data['password']);
						$_SESSION['email'] = $data['email'];
						$_SESSION['phone'] = $data['phone'];
						$_SESSION['secretpin'] = $data['secretpin'];
						$_SESSION['isAdmin'] = $data['isAdmin'];
						header('Location: dashboard.php');
						exit;
					}
					else
						$errMsg = 'Password not match.';
				}
			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
		}
	}
?>

<html>
<head>
	<link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="./img/murom.png"/>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<title>Login</title>
</head>
<body>
	<div>
		<?php
			if(isset($errMsg)){
				echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
			}
		?>
		<div class="main_login">
			<p class="sign" align="center">Log in</p>
			<form class="form1" action="" method="post">
				<input class="un " type="text" name="username" align="center" placeholder="Username" value="<?php if(isset($_POST['username'])) echo $_POST['username'] ?>"/>
				<input class="pass" type="password" name="password" align="center" placeholder="Password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>"/>
				<input class="submit" align="center" type="submit" name='login' value="Login" />
			</form>
			<p class="forgot" align="left"><a href="forgot.php">Forgot Password?</p>
			<p style="padding-left:150px" class="forgot" align="right"><a href="register.php">Register</p>
		</div>
	</div>
</body>
</html>
