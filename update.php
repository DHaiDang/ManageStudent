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
						':password' => md5($password),
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
		session_destroy();
		echo "<script>
			alert('Successfully updated. Please relogin.');
			window.location.href='dashboard.php';
			</script>";
		}
?>