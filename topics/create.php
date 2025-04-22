<?php require "../includes/header.php"; ?>
<?php require "../config/config.php" ?>

<?php 






	if (isset($_POST['submit'])) {
    if (empty($_POST['title']) || empty($_POST['category']) || empty($_POST['body'])) {
        echo "<script>alert('Field are require* !');</script>";

    } else {
				$title = $_POST['title'];
				$category = $_POST['category'];
				$body = $_POST['body'];
				$user_name = $_SESSION['name'];

        // Prepare and execute the query with error handling
        // try {
				// Fetch the user's image from the users table
        $user_query = $conn->prepare("SELECT avatar FROM users WHERE username = :username");
        $user_query->execute([':username' => $user_name]);
        $user = $user_query->fetch(PDO::FETCH_ASSOC);
        $user_image = $user['avatar'] ?? 'default_image.jpg'; // Use a default if no image exists

        // Prepare and execute the query with user_image included
        try {
            $insert = $conn->prepare("INSERT INTO Topics (title, category, body, user_name, user_image) 
                VALUES (:title, :category, :body, :user_name, :user_image)");
            $insert->execute([
                ":title" => $title,
                ":category" => $category,
                ":body" => $body,
                ":user_name" => $user_name,
                ":user_image" => $user_image
            ]);
            header("location: ".APPURL."");        
        } catch (PDOException $e) {
            echo "<script>alert('Database error: " . $e->getMessage() . "');</script>";
        }


    }
}

 // grapping categories

 $categories_select = $conn->query("SELECT * FROM categories");
 $categories_select->execute();

 $allCats = $categories_select->fetchAll(PDO::FETCH_OBJ);



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
						<form role="form" method="POST" action="create.php">
							<div class="form-group">
								<label>Topic Title</label>
								<input type="text" class="form-control" name="title" placeholder="Enter Post Title">
							</div>
							<div class="form-group">
								<label>Category</label>
								<select name="category" class="form-control">
									<?php foreach($allCats as $cat) : ?>
										<option value="<?php echo $cat->name; ?>"><?php echo $cat->name; ?></option>
									<?php endforeach;?>
							</select>
							</div>
								<div class="form-group">
									<label>Topic Body</label>
									<textarea id="body" rows="10" cols="80" class="form-control" name="body"></textarea>
									<script>CKEDITOR.replace('body');</script>
								</div>
							<button type="submit" name="submit" class="color btn btn-default">Create</button>
						</form>
					</div>
				</div>
			</div>

<?php require "../includes/footer.php"; ?>

