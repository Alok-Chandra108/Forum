<?php require "../layouts/header.php"; ?>
<?php require "../../config/conf.php"; ?>

<?php 

if(!isset($_SESSION['email'])){
  header("location: ".ADMINURL."/admins/login-admins.php");
}


if(isset($_POST['submit'])){

if( empty($_POST['name']) ){
echo "<script>alert('Please fill all the fields');</script>";
}else{

$name=$_POST['name'];

$insert=$conn->prepare("INSERT INTO categories (name)
VALUES (:name)");

$insert->execute([
  
  ":name" => $name,
  
]);
header("location: show-categories.php");
}
}

?>

       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Categories</h5>
          <form method="POST" action="create-category.php">
                <!-- Name input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example2" class="form-control" placeholder="Name" />
                 
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