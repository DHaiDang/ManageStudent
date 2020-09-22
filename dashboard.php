<?php
	require 'config.php';
	if(empty($_SESSION['name']))
		header('Location: login.php');
?>

<?php
	print_r($_POST['username']);
	if(isset($_POST['update'])) {
		$errMsg = '';
		print_r($_POST['username']);
		// Getting data from FROM

		$secretpin = $_POST['secretpin'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];

		if($errMsg == '') {
			try {
		      $sql = "UPDATE student SET  password = :password, secretpin = :secretpin,email = :email, phone = :phone WHERE username = :username";
		      $stmt = $connect->prepare($sql);                                  
		      $stmt->execute(array(
		        ':fullname' => $_SESSION['fullname'],
						':secretpin' => $secretpin,
						':email' => $email,
						':phone' => $phone,
		        ':password' => $password,
		        ':username' => $_SESSION['username']
		      ));
				header('Location: update.php?action=updated');
				exit;
			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
		}
	}

	if(isset($_GET['action']) && $_GET['action'] == 'updated')
		// $errMsg = 'Successfully updated. <a href="logout.php">Logout</a> and login to see update.';
		header('Location: login.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Viettel</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<style>
	body {font-family: "Times New Roman", Georgia, Serif;}
	h1, h2, h3, h4, h5, h6 {
		font-family: "Playfair Display";
		letter-spacing: 5px;
	}
	</style>
</head>
<body>

<div class="w3-top">
  <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
		<a href="" class="w3-bar-item w3-button">Viettel Cyber Sencurity</a>
		
    <div class="w3-right w3-hide-small">
      <a href="#info" class="w3-bar-item w3-button">Info</a>
      <a href="#students" class="w3-bar-item w3-button">Students</a>
			<a href="#homework" class="w3-bar-item w3-button">HomeWork</a>
			<a href="logout.php" class="w3-bar-item w3-button">Logout</a>
			<p class="w3-bar-item" style="margin:0;color: #768bcf;font-weight:bold;"><?php echo $_SESSION['name']; ?></p>
    </div>
  </div>
</div>

<header class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">
  <img class="w3-image" src="/w3images/hamburger.jpg" alt="Hamburger Catering" width="1600" height="800">
  <div class="w3-display-bottomleft w3-padding-large w3-opacity">
    <h1 class="w3-xxlarge">Le Catering</h1>
  </div>
</header>

<!-- Page content -->
<div class="w3-content" style="max-width:1100px" id="info">

  <!-- About Section -->
  <div class="w3-row w3-padding-64">
    <div class="w3-col m6 w3-padding-large w3-hide-small">
     <img src="./img/murom.png" class="w3-round w3-image w3-opacity-min" alt="Table Setting" width="600" height="750">
    </div>

    <div class="w3-col m6 w3-padding-large">
			<h1 class="w3-center">Infomation</h1><br>
			<form action="" method="post">
				<input class="un" type="text" name="fullname" value="<?php echo $_SESSION['name']; ?>" class="un" style="cursor:not-allowed" disabled/>
				<input class="un" type="text" name="username" value="<?php echo $_SESSION['username']; ?>" style="cursor:not-allowed" disabled />
				<input class="un" type="text" name="secretpin" value="<?php echo $_SESSION['secretpin']; ?>" autocomplete="off"/>
				<input class="un" type="text" name="email" value="<?php echo $_SESSION['email']; ?>" autocomplete="off"/>
				<input class="un" type="text" name="phone" value="<?php echo $_SESSION['phone']; ?>" autocomplete="off"/>
				<input class="pass" type="password" name="password" align="center" value="<?php echo $_SESSION['password'] ?>"/>
				<input type="submit" name='update' value="Update" class='submit'/>
			</form>
    </div>
  </div>
  
  <hr>
  
  <!-- Menu Section -->
  <div class="w3-row w3-padding-64" id="students">
    <div class="w3-col l6 w3-padding-large">
			<h1 class="w3-center">Students</h1><br>
			<table id="customers">
				<tr>
					<th>Name</th>
					<th>Edit</th>
				</tr>
				<?php
					$conn = mysqli_connect("localhost", "hdang", "Haidang@123456789", "Manage");
					if($conn -> connect_error) {
						die("Connection failed: ". $conn -> connect_error );
					}
					$sql = "SELECT id, fullname, email, phone, username, isAdmin FROM student";
					$result = $conn -> query($sql);
					$admin = $_SESSION['isAdmin'];
					if($result -> num_rows > 0) {
						while($row = $result -> fetch_assoc()) {
							if(intval($admin) == 1) {
								echo "<tr><td>". 
								$row['fullname']."</td><td>".
								"<a href='update.php?id=".$row['id']."'>edit</a>".
								"</td></tr>".
								"<tr class='hide'><td>". 
								$row['id']."</td><td>".
								$row['username']."</td><td>".
								$row['email']."</td><td>".
								$row['phone'].
								"</td></tr>"
								;
							}
							else {
								echo "<tr><td>". 
								$row['fullname']."</td><td>".
								"<a>None</a>".
								"</td></tr>".
								"<tr class='hide'><td>". 
								$row['id']."</td><td>".
								$row['username']."</td><td>".
								$row['email']."</td><td>".
								$row['phone'].
								"</td></tr>"
								;
							}
						}
					}
				?>
			</table>
    </div>
    
    <div class="w3-col l6 w3-padding-large">
      <img src="./img/zoro.jpg" class="w3-round w3-image w3-opacity-min" alt="Menu" style="width:100%">
    </div>
  </div>

  <hr>

  <!-- Contact Section -->
  <!-- <div class="w3-container w3-padding-64" id="homework">
    <h1>Home work</h1><br>
	</div> -->
	<div class="w3-row w3-padding-64" id="homework">
    <div class="w3-col m6 w3-padding-large w3-hide-small">
     <img src="./img/luffy.jpg" class="w3-round w3-image w3-opacity-min" alt="Table Setting" width="600" height="750">
    </div>

    <div class="w3-col m6 w3-padding-large">
			<h1 class="w3-center">Home work</h1><br>
    </div>
  </div>
</div>

</body>
</html>
