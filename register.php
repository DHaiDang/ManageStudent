<?php
	require 'config.php';

	if(isset($_POST['register'])) {
		$errMsg = '';
		$fullname = $_POST['fullname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$secretpin = $_POST['secretpin'];

		if($fullname == '')
			$errMsg = 'Enter your fullname';
		if($username == '')
			$errMsg = 'Enter username';
		if($password == '')
			$errMsg = 'Enter password';
		if($email == '')
			$errMsg = 'Enter email';
		if($phone == '')
			$errMsg = 'Enter phone number';
		if($secretpin == '')
			$errMsg = 'Enter secretpin';

		if($errMsg == ''){
			try {
				$stmt = $connect->prepare('INSERT INTO student (fullname, username, password, email, phone, secretpin) VALUES (:fullname, :username, :password, :email, :phone, :secretpin)');
				$stmt->execute(array(
					':fullname' => $fullname,
					':username' => $username,
					':password' => md5($password),
					':email' => $email,
					':phone' => $phone,
					':secretpin' => $secretpin,
					));
				header('Location: register.php?action=joined');
				exit;
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}

	if(isset($_GET['action']) && $_GET['action'] == 'joined') {
		// $errMsg = 'Registration successfull. Now you can <a href="login.php">login</a>';
		header('Location: login.php');
	}
?>

<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<link rel="icon" href="./img/murom.png"/>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<title></title>
</head>
<body>
	<div>
		<?php
			if(isset($errMsg)){
				echo '<div">'.$errMsg.'</div>';
			}
		?>
		<div class="main_login_register">
			<p class="sign" align="center">Register</p>
			<form class="form1" action="" method="post">
				<input class="un " type="text" name="username" align="center" placeholder="Username" value="<?php if(isset($_POST['username'])) echo $_POST['username'] ?>"/>
				<input class="pass" type="password" name="password" align="center" placeholder="Password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>"/>
				<input class="un " type="text" name="fullname" align="center" placeholder="fullname" value="<?php if(isset($_POST['fullname'])) echo $_POST['fullname'] ?>"/>
				<input class="un " type="text" name="email" align="center" placeholder="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>"/>
				<input class="un " type="text" name="phone" align="center" placeholder="phone" value="<?php if(isset($_POST['phone'])) echo $_POST['phone'] ?>"/>
				<input class="un " type="text" name="secretpin" align="center" placeholder="secretpin" value="<?php if(isset($_POST['secretpin'])) echo $_POST['secretpin'] ?>"/>
				<input class="submit" align="center" type="submit" name='register' value="Register" />
			</form>
			<p style="padding-left:180px" class="forgot" align="right"><a href="login.php">Login</p>
		</div>
	</div>
</body>
</html>
