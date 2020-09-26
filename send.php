<?php
  require 'config.php';
  if(empty($_SESSION['name']))
		header('Location: login.php');
  $id = $_POST['id'];
  $mess = $_POST['mess'];
  //print_r($id);
  //echo($_SESSION['name'].": ".$_POST['mess'])."-".date("d F Y H:i:s");
  $mess = $_SESSION['name'].": ".$_POST['mess']."-".date("d F Y H:i:s");
  if(isset($_POST['send'])) {
    try {
      $sql = 'UPDATE student SET mess = :mess WHERE id ='.$id;
      $stmt = $connect->prepare($sql);
      $stmt->execute(array(
        ':mess' => $mess,
        ));
      header("Location : dashboard.php");
      exit;
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
  }
?>
