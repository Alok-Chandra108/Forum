<?php require "../layouts/header.php"; ?>
<?php require "../../config/conf.php"; ?>
<?php 

		if(!isset($_SESSION['email'])){
			header("location: ".ADMINURL."/admins/login-admins.php");
		}


	if(isset($_POST['submit'])){

 if( empty($_POST['email']) OR empty($_POST['adminname'])
	OR empty($_POST['password']) ){
		echo "<script>alert('Please fill all the fields');</script>";
	}else{
		
		$email=$_POST['email'];
		$adminname=$_POST['adminname'];
    $password= password_hash($_POST['password'], PASSWORD_DEFAULT);

	
		$insert=$conn->prepare("INSERT INTO admins (email,adminname,password)
    VALUES (:email,:adminname,:password)");
		
		$insert->execute([
			
			":email" => $email,
			":adminname" => $adminname,
			":password" => $password,
	
		]);
		header("location: admins.php");
	}
	}

?>

       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="create-admins.php" >
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                 
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="adminname" id="form2Example1" class="form-control" placeholder="Admin Name" />
                </div>
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example1" class="form-control" placeholder="Password" />
                </div>

                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
  </div>
  <?php require "../layouts/footer.php"; ?>