<?php require "../includes/header.php";		?>
<?php require "../config/conf.php";			?>
<?php 

    if(isset($_SESSION['email'])){
        header("location: ".APPURL."");
    }


	if(isset($_POST['submit'])){
      //getting the data
      $email=$_POST['email'];
      $password=$_POST['password'];

      //query
      $login=$conn->query("SELECT *FROM users WHERE email='$email'");
      $login->execute();
      $fetch = $login->fetch(PDO::FETCH_ASSOC);
      
      if($login->rowCount()>0){
        if(password_verify($password ,$fetch['password'])){
          $_SESSION['username'] = $fetch['username'];
          $_SESSION['name'] = $fetch['name'];
          $_SESSION['user_id'] = $fetch['id'];
          $_SESSION['email'] = $fetch['email'];
          $_SESSION['user_image'] = $fetch['avatar'];

          header("location: ".APPURL."");
        }else{
          echo "<script>alert('Email or Password is wrong');</script>";
        }
        
      }else{
        echo "<script>alert('Email or Password is wrong');</script>";
      }
  }
  ?>

    <div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="main-col">
					<div class="block">
						<h1 class="pull-left">Login </h1>
						<h4 class="pull-right">A Simple Forum</h4>
						<div class="clearfix"></div>
						<hr>
						<form role="form" method="post" action="login.php">
							
							<div class="form-group">
							<label>Email Address*</label> <input type="email" class="form-control"
							name="email" placeholder="Enter Your Email Address" required>
							</div>
					
					<div class="form-group">
                        <label>Password*</label> <input type="password" class="form-control"
                    name="password" placeholder="Enter A Password" required>
                    </div>
	
			        <input name="submit" type="submit" class="color btn btn-default" value="Login" />
        </form>
					</div>
				</div>
			</div>
			<?php require "../includes/footer.php";		?>
