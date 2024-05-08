<?php require "../includes/header.php";		?>
<?php require "../config/conf.php";			?>
 <?php 

		if(!isset($_SESSION['username'])){
			header("location: ".APPURL."");
		}
		
        //grabing the data
        if(isset($_GET['id'])){

            $id = $_GET['id'];

            $select = $conn->query("SELECT * FROM topics WHERE id='$id'");
            $select->execute();
            $topic=$select->fetch(PDO::FETCH_OBJ);

            if($topic->user_name !== $_SESSION['username']){
                header("loctaion: ".APPURL."");
            }

        }

	if(isset($_POST['submit'])){

 
		if(empty($_POST['title']) OR empty($_POST['category']) OR empty($_POST['body'])){
			echo "<script>alert('Please fill all the fields');</script>";
		}else{
			$title=$_POST['title'];
			$category=$_POST['category'];
			$body=$_POST['body'];
			$user_name=$_SESSION['username'];

		$update=$conn->prepare("UPDATE topics SET title = :title, category = :category,
        body = :body,user_name = :user_name where id=$id");
		
		$update->execute([
			":title" => $title,
			":category" => $category,
			":body" => $body,
			":user_name"=> $user_name,
		]);
		header("location: ".APPURL." ");
	}
	}

?>   
<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="main-col">
					<div class="block">
						<h1 class="pull-left">Update Topic</h1>
						<div class="clearfix"></div>
						<hr>
						<form role="form" action="update.php?id=<?php echo $id; ?>" method="POST">
							<div class="form-group">
								<label>Topic Title</label>
								<input type="text" value="<?php echo $topic->title; ?>" class="form-control" name="title" placeholder="Enter Post Title">
							</div>
							<div class="form-group">
    <label>Category</label>
    <select name="category" class="form-control">
        <?php
            // Define your category options
            $categories = array("Design", "Development", "Marketing", "SEO", "Hosting");

            // Loop through each category option
            foreach ($categories as $cat) {
                // Check if the current category matches the topic's category
                $selected = ($cat == $topic->category) ? "selected" : "";
                echo "<option value=\"$cat\" $selected>$cat</option>";
            }
        ?>
    </select>
</div>

								<div class="form-group">
									<label>Topic Body</label>
									<textarea id="body" rows="10" cols="80" class="form-control" name="body"><?php echo $topic->body; ?></textarea>
									<script>CKEDITOR.replace('body');</script>
								</div>
							<button type="submit" name="submit" class="color btn btn-default">Update</button>
						</form>
					</div>
				</div>
			</div>
            <?php require "../includes/footer.php"; ?>