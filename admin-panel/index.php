<?php require "layouts/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 
  if(!isset($_SESSION['adminname'])){
    header("location: ".ADMINURL."/admins/login-admins.php");
  }
  // All Topics
  $topics = $conn->query("SELECT COUNT(*) AS count_topics FROM Topics");
  $topics->execute();

  $allTopics = $topics->fetch(PDO::FETCH_OBJ);

  // All Categories
  $categories = $conn->query("SELECT COUNT(*) AS count_categories FROM categories");
  $categories->execute();

  $allcategories = $categories->fetch(PDO::FETCH_OBJ);

  // All Admins
  $admins = $conn->query("SELECT COUNT(*) AS count_admins FROM admins");
  $admins->execute();

  $alladmins = $admins->fetch(PDO::FETCH_OBJ);

  // All Replies
  $replies = $conn->query("SELECT COUNT(*) AS count_replies FROM replies");
  $replies->execute();

  $allreplies = $replies->fetch(PDO::FETCH_OBJ);
?>

<div class="row">
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Topics</h5>
        <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
        <p class="card-text">number of topics: <?php echo $allTopics->count_topics; ?></p>
        
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Categories</h5>
        
        <p class="card-text">number of categories:  <?php echo $allcategories->count_categories; ?></p>
        
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Admins</h5>
        
        <p class="card-text">number of admins: <?php echo $alladmins->count_admins; ?></p>
        
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Replies</h5>
        
        <p class="card-text">number of replies:  <?php echo $allreplies->count_replies; ?></p>
        
      </div>
    </div>
  </div>
</div>

<?php require "layouts/footer.php"; ?>
