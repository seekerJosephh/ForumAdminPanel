<?php require "../includes/header.php"; ?>
<?php require "../config/config.php" ?>

<?php 

  if(!isset($_SESSION['username'])) {
    header("location: ".APPURL."");
  }

  // grapping the data
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $select = $conn->query("SELECT * FROM users WHERE id='$id'");
    $select->execute();

    $user = $select->fetch(PDO::FETCH_OBJ);
  }

	if (isset($_POST['submit'])) {

    if (empty($_POST['email']) || empty($_POST['about'])) {
        echo "<script>alert('Field are require* !');</script>";

    } else {
				$email = $_POST['email'];
				$about = $_POST['about'];


        // Prepare and execute the query with error handling
        // try {
				$update = $conn->prepare("UPDATE users SET email = :email, about = :about WHERE id='$id'");
				$update->execute([
						":email" => $email,
						":about" => $about,
				]);
				header("location: ".APPURL."");		
        // } catch (PDOException $e) {
        //     echo "<script>alert('Database error: " . $e->getMessage() . "');</script>";
        // }
    }
}


?>

    <div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="main-col">
					<div class="block">
						<h1 class="pull-left">Create A Topic</h1>
						<h4 class="pull-right">A Simple Forum</h4>
						<div class="clearfix"></div>
						<hr>
						<form role="form" method="POST" action="edit-user.php?id=<?php echo $id; ?>">
							<div class="form-group">
								<label>Topic Title</label>
								<input type="text" value="<?php echo $user->email; ?>" class="form-control" name="email" placeholder="Enter Email">
							</div>
								<div class="form-group">
									<label>Topic Body</label>
									<textarea id="body" rows="10" cols="80" class="form-control" name="about"><?php echo $user->about; ?></textarea>
									<script>CKEDITOR.replace('body');</script>
								</div>
							<button type="submit" name="submit" class="color btn btn-default">Update</button>
						</form>
					</div>
				</div>
			</div>

<?php require "../includes/footer.php"; ?>

