<?php require "../includes/header.php"; ?>
<?php require "../config/config.php" ?>


<?php 

    if(isset($_GET['id'])) {
      $id = $_GET['id'];

      $delete = $conn->query("DELETE FROM Topics WHERE id='$id'");

      $delete->execute();

      header("location: ".APPURL."");
    }

?>