<?php
	require 'config.php';

	if(isset($_POST['forgotpass'])) {
		$errMsg = '';

		// Getting data from FROM
		$secretpin = $_POST['secretpin'];

		if(empty($secretpin))
			$errMsg = 'Please enter your secret pin to view your password.';

		if($errMsg == '') {
			try {
				$stmt = $connect->prepare('SELECT password, secretpin FROM student WHERE secretpin = :secretpin');
				$stmt->execute(array(
					':secretpin' => $secretpin
					));
				$data = $stmt->fetch(PDO::FETCH_ASSOC);
				if($secretpin == $data['secretpin']) {
					$viewpass = '<p class="passForgotText">Your password is: ' . $data['password'] . '<br><a class="passForgot" href="login.php">Login Now</a><p>';
				}
				else {
					$errMsg = 'Sercet pin not matched.';
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
	<title>Forgot Password</title>
	<link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>
	<div>
		<?php
			if(isset($errMsg)){
				echo '<div>'.$errMsg.'</div>';
			}
		?>
		<?php
			if(isset($viewpass)){
				echo '<div>'.$viewpass.'</div>';
			}
		?>
		<div class="main_login">
			<p class="sign" align="center">Forgot password</p>
			<form class="form1" action="" method="post">
				<input class="un" type="text" name="secretpin" align="center" placeholder="Secret Pin"/>
				<input class="submit" align="center" type="submit" name='forgotpass' value="Check" />
			</form>
			<p style="padding-left:180px" class="forgot" align="center"><a href="login.php">Login</p>
		</div>
	</div>
</body>
</html>