<?php require "../layouts/header.php"; ?>
<?php require "../../config/conf.php"; ?>

<?php 
    if(!isset($_SESSION['email'])){
			header("location: ".ADMINURL."/admins/login-admins.php");
		}

    if(isset($_GET['id'])){
      $id= $_GET['id'];

      $Category = $conn->query("SELECT * FROM categories WHERE id='$id'");
  $Category->EXECUTE();
  $singleCategory = $Category->fetch(PDO::FETCH_OBJ);

    }

    if(isset($_POST['submit'])){

      if( empty($_POST['name']) ){
      echo "<script>alert('Please fill all the fields');</script>";
      }else{
      
      $name=$_POST['name'];
      
      $update=$conn->prepare("UPDATE categories SET name=:name WHERE 
      ID='$id'");
      
      $update->execute([
        
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
              <h5 class="card-title mb-5 d-inline">Update Categories</h5>
          <form method="POST" action="update-category.php?id=<?php echo $id;  ?>">
                <!-- Cat4egory input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" value="<?php echo $singleCategory->name; ?>" id="form2Example1" class="form-control" placeholder="New Name" />
                 
                </div>

                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
  </div>
  <?php require "../layouts/footer.php"; ?>