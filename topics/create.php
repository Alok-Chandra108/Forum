<?php require "../includes/header.php";		?>
<?php require "../config/conf.php";			?>
 <?php 

		if(!isset($_SESSION['email'])){
			header("location: ".APPURL."");
		}
		
	if(isset($_POST['submit'])){

 
		if(empty($_POST['title']) OR empty($_POST['category']) OR empty($_POST['body'])){
			echo "<script>alert('Please fill all the fields');</script>";
		}else{
			$title=$_POST['title'];
			$category=$_POST['category'];
			$body=$_POST['body'];
			$user_name=$_SESSION['username'];
			$user_image=$_SESSION['user_image'];

		$insert=$conn->prepare("INSERT INTO topics (title,category,body,user_name,user_image
		)VALUES (:title,:category,:body,:user_name,:user_image)");
		
		$insert->execute([
			":title" => $title,
			":category" => $category,
			":body" => $body,
			":user_name"=> $user_name,
			":user_image"=> $user_image,
		]);
		header("location: ".APPURL." ");
	}
	}

	//categories selection
	$categories_select = $conn->query("SELECT * FROM categories");
	$categories_select -> execute();
	$allcategories = $categories_select -> fetchAll(PDO::FETCH_OBJ);

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
						<form role="form" action="create.php" method="POST">
							<div class="form-group">
								<label>Topic Title</label>
								<input type="text" class="form-control" name="title" placeholder="Enter Post Title">
							</div>
							<div class="form-group">
								<label>Category</label>
								<select name="category" class="form-control">
								<?php foreach($allcategories as $cat) : ?>	
								<option value="<?php echo $cat->name; ?>"><?php echo $cat->name; ?></option>
									<?php endforeach; ?>
							</select>
							</div>
								<div class="form-group">
									<label>Topic Body</label>
									<textarea id="body" rows="10" cols="80" class="form-control" name="body"></textarea>
									<script>CKEDITOR.replace('body');</script>
								</div>
							<button type="submit" name="submit" class="color btn btn-default">Submit</button>
						</form>
					</div>
				</div>
			</div>
			<?php require "../includes/footer.php";		?>