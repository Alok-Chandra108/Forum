<?php require "../includes/header.php";		?>
<?php require "../config/conf.php";			?>
<?php

if(isset($_GET['id'])){
	$id= $_GET['id'];

	$topic=$conn->query("SELECT * FROM topics WHERE id='$id'");
	$topic->execute();

	$singleTopic= $topic->fetch(PDO::FETCH_OBJ);

	//no of post for every users
	$topicCount = $conn->query("SELECT COUNT(*) AS count_topics FROM topics WHERE user_name='$singleTopic->user_name'");
	$topicCount->execute();
	$count = $topicCount->fetch(PDO::FETCH_OBJ);

	//grouping replies 
	$reply=$conn->query("SELECT * FROM replies WHERE topic_id='$id'");
	$reply->execute();

	$allReplies= $reply->fetchAll(PDO::FETCH_OBJ);

}
else{
	header("location: ".APPURL."/404.php");
}

if(isset($_POST['submit'])){

 
	if(empty($_POST['reply'])){
		echo "<script>alert('Please fill all the fields');</script>";
	}else{
		$reply=$_POST['reply'];
		$user_id=$_SESSION['user_id'];
		$topic_id=$id;
		$user_name=$_SESSION['username'];
		$user_image=$_SESSION['user_image'];

	$insert=$conn->prepare("INSERT INTO replies (reply, user_id, topic_id, user_name,user_image
	)VALUES (:reply,:user_id,:topic_id,:user_name,:user_image)");
	
	$insert->execute([
		":reply" => $reply,
		":user_id" => $user_id,
		":topic_id" => $topic_id,
		":user_name"=> $user_name,
		":user_image"=> $user_image,
	]);
	header("location: ".APPURL."/topics/topic.php?id= ".$id."");
}
header("location: ".APPURL."");
}

?>
    <div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="main-col">
					<div class="block">
						<h1 class="pull-left"><?php echo $singleTopic->title; ?></h1>
						<!-- <h4 class="pull-right">A Simple Forum</h4> -->
						<div class="clearfix"></div>
						<hr>
						<ul id="topics">
					<li id="main-topic" class="topic topic">
						<div class="row">
							<div class="col-md-2">
								<div class="user-info">
									<img class="avatar pull-left rounded-circle" style="border-radius: 50%;" src="../img/<?php echo $singleTopic->user_image; ?>" />
									<ul>
										<li><strong><?php echo $singleTopic->user_name; ?></strong></li>
										<li><?php echo $count->count_topics; ?> Posts</li>
										<li><a href="<?php echo APPURL; ?>/users/profile.php?name=<?php echo $singleTopic->user_name; ?>">Profile</a>
									</ul>
								</div>
							</div>
							<div class="col-md-10">
								<div class="topic-content pull-right">
									<p><?php echo $singleTopic->body; ?></p>
								</div>
								<?php if(isset($_SESSION['username'])) : ?>

								<?php if($singleTopic->user_name == $_SESSION['username']) : ?>
								<a class="btn btn-danger" href="delete.php?id=<?php echo $singleTopic->id; ?>" role="button">Delete</a>
								<a class="btn btn-warning" href="update.php?id=<?php echo $singleTopic->id; ?>" role="button">Update</a>
								<?php endif; ?>	
								<?php endif; ?>	
							</div>
						</div>
					</li>
					<?php foreach($allReplies as $reply) : ?>
					<li class="topic topic">
						<div class="row">
							<div class="col-md-2">
								<div class="user-info">
									<img class="avatar pull-left rounded-circle" style="border-radius: 50%;" src="../img/<?php echo $reply->user_image;?>" />
									<ul>
										<li><strong><?php echo $reply->user_name;?></strong></li>
										<li><a href="<?php echo APPURL; ?>/users/profile.php?name=<?php echo $reply->user_name; ?>">Profile</a>
									</ul>
								</div>
							</div>
							<div class="col-md-10">
								<div class="topic-content pull-right">
									<p><?php echo $reply->reply;?></p>
								</div>
								<?php if(isset($_SESSION['username'])) : ?>

								<?php if($reply->user_id == $_SESSION['user_id']) : ?>
								<a class="btn btn-danger" href="../replies/delete.php?id=<?php echo $reply->id; ?>" role="button">Delete</a>
								<a class="btn btn-warning" href="../replies/update.php?id=<?php echo $reply->id; ?>" role="button">Update</a>
								<?php endif; ?>	
								<?php endif; ?>	

							</div>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php if(isset($_SESSION['username'])) : ?>
				<h3>Reply To Topic</h3>
				<form role="form" method="post" action="topic.php?id=<?php echo $id; ?>">				
  					<div class="form-group">
						<textarea id="reply" rows="10" cols="80" class="form-control" name="reply"></textarea>
						<script>
							CKEDITOR.replace( 'reply' );
            			</script>
  					</div>
 					 <button type="submit" name="submit" class="color btn btn-default">Submit</button>
				</form>
				<?php endif; ?>
					</div>
				</div>
			</div>
			<?php require "../includes/footer.php";		?>