<?php
  require 'config.php';

  $fullname = 'Teacher';
    $id = 0;
		$username = 'teacher';
		$password ='0403';
		$email = 'teacher@gmail.com';
		$phone = '0979791603';
    $secretpin = '1234';
    $isAdmin = 1;
  try {
  $stmt = $connect->prepare('INSERT INTO student (id, fullname, username, password, email, phone, secretpin, isAdmin) VALUES (:id, :fullname, :username, :password, :email, :phone, :secretpin, :isAdmin)');
  $stmt->execute(array(
    ':id' => $id,
    ':fullname' => $fullname,
    ':username' => $username,
    ':password' => md5($password),
    ':email' => $email,
    ':phone' => $phone,
    ':secretpin' => $secretpin,
    ':isAdmin' => $isAdmin,
    ));

    exit;
  }
  catch(PDOException $e) {
    echo $e->getMessage();
  }
?>