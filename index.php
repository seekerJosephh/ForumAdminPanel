<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>

<?php 

$topics = $conn->query("SELECT Topics.id AS id, Topics.title AS title, Topics.category AS category, 
    Topics.user_name AS user_name, Topics.user_image AS user_image, Topics.created_at AS created_at, 
    COUNT(replies.topic_id) AS count_replies 
    FROM Topics 
    LEFT JOIN replies ON Topics.id = replies.topic_id 
    GROUP BY Topics.id");


	$topics->execute();
	
	$allTopics = $topics->fetchAll(PDO::FETCH_OBJ);

?> 
    <div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="main-col">
					<div class="block">
						<h1 class="pull-left">Welcome to Forum</h1>
						<h4 class="pull-right">A Simple Forum</h4>
						<div class="clearfix"></div>
						<hr>
						<ul id="topics">
							<?php foreach($allTopics as $topics) : ?> 
								<li class="topic">
									<div class="row">
									<div class="col-md-2">
										<img class="avatar pull-left" src="img/<?php echo $topics->user_image;?>" />
									</div>
									<div class="col-md-10">
										<div class="topic-content pull-right">
											<h3><a href="topics/topic.php?id=<?php echo $topics->id; ?>"><?php echo $topics->title;?></a></h3>
											<div class="topic-info">
												<a href="category.html"><?php echo $topics->category;?></a> >> <a href="profile.html"><?php echo $topics->user_name;?></a> >> Posted on: <?php echo $topics->created_at;?>
												<span class="color badge pull-right"><?php echo $topics->count_replies;?></span>
											</div>
										</div>
									</div>
								</div>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
			

<?php require "includes/footer.php"; ?>