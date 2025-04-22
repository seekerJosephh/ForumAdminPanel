<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php 

if (isset($_POST['submit'])) {
  if (empty($_POST['email']) || empty($_POST['password'])) {
      echo "<script>alert('One or more inputs are empty');</script>";
  } else {
      // Get the data
      $email = $_POST['email'];
      $password = $_POST['password'];

      // Prepare and execute the query with a prepared statement
      try {
          $login = $conn->prepare("SELECT * FROM users WHERE email = :email");
          $login->execute([':email' => $email]);

          $fetch = $login->fetch(PDO::FETCH_ASSOC);

          if ($login->rowCount() > 0) {
              if (password_verify($password, $fetch['password'])) {

                  // $_SESSION['username'] = $fetch['username'];
                  // $_SESSION['name'] = $fetch['name'];
                  // $_SESSION['user_id'] = $fetch['id'];
                  // $_SESSION['email'] = $fetch['email'];
                  // $_SESSION['user_image'] = $fetch['image'];

                  // header("location: ".APPURL."");
                echo "<script>alert('LOGGED IN');</script>";


              } else {
                  echo "<script>alert('Email or password is wrong');</script>";
              }
          } else {
              echo "<script>alert('Email or password is wrong');</script>";
          }
      } catch (PDOException $e) {
          echo "<script>alert('Database error: " . $e->getMessage() . "');</script>";
      }
  }
}

?>


  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mt-5">Login</h5>
          <form method="POST" class="p-auto" action="login-admins.php">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                
              </div>

              
              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                
              </div>



              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

              
            </form>

        </div>
    </div>
  </div>
</div>

<?php require "../layouts/footer.php"; ?>
