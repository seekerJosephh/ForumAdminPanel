<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>

<?php 
  $admins = $conn->query("SELECT * FROM admins");
  $admins->execute();

  $allAdmins = $admins->fetch(PDO::FETCH_OBJ);
?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Admins</h5>
        <a  href="create-admins.html" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">username</th>
              <th scope="col">email</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row"><?php echo $allAdmins->id; ?></th>
              <td><?php echo $allAdmins->adminname;?></td>
              <td><?php echo $allAdmins->email;?></td>
              
            </tr>
            
          </tbody>
        </table> 
      </div>
    </div>
  </div>
</div>

<?php require "../layouts/footer.php"; ?>


