<?php
require "../includes/header.php";
require "../config/config.php";

// if(isset($_SESSION['username'])) {
//   header("location: ".APPURL."");
// }

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

                    $_SESSION['username'] = $fetch['username'];
                    $_SESSION['name'] = $fetch['name'];
                    $_SESSION['user_id'] = $fetch['id'];
                    $_SESSION['email'] = $fetch['email'];
                    $_SESSION['user_image'] = $fetch['image'];

                    header("location: ".APPURL."");


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
    <div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="main-col">
					<div class="block">
						<h1 class="pull-left">Login</h1>
						<h4 class="pull-right">A Simple Forum</h4>
						<div class="clearfix"></div>
						<hr>
						<form role="form"  method="post" action="login.php">
							
							<div class="form-group">
							<label>Email Address*</label> <input type="email" class="form-control"
							name="email" placeholder="Enter Your Email Address">
							</div>
					
					<div class="form-group">
                        <label>Password*</label> <input type="password" class="form-control"
                    name="password" placeholder="Enter A Password">
                    </div>
	
			        <input name="submit" type="submit" class="color btn btn-default" value="Login" />
        </form>
					</div>
				</div>
			</div>

<?php require "../includes/footer.php"; ?>