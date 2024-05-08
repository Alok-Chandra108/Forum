<?php require "../layouts/header.php"; ?>
<?php require "../../config/conf.php"; ?>

<?php 
    if(!isset($_SESSION['email'])){
			header("location: ".ADMINURL."/admins/login-admins.php");
		}

  $Categories = $conn->query("SELECT * FROM categories");
  $Categories->EXECUTE();
  $allCategories = $Categories->fetchAll(PDO::FETCH_OBJ);
  

?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Categories</h5>
                <a  href="<?php echo ADMINURL; ?>/categories-admins/create-category.php" class="btn btn-primary mb-4 text-center float-right">Create Categories</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($allCategories as $Category) : ?>
                        <tr>
                            <th scope="row"><?php echo $Category->id; ?></th>
                            <td><?php echo $Category->name; ?></td>
                            <td>
                                <a href="update-category.php?id=<?php echo $Category->id; ?>" class="btn btn-warning text-white text-center d-none d-sm-inline">
                                    <i class="fas fa-edit"></i> Update
                                </a>
                                <a href="update-category.php?id=<?php echo $Category->id; ?>" class="btn btn-warning text-white text-center d-inline d-sm-none">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <a href="delete-category.php?id=<?php echo $Category->id; ?>" class="btn btn-danger text-center d-none d-sm-inline">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                                <a href="delete-category.php?id=<?php echo $Category->id; ?>" class="btn btn-danger text-center d-inline d-sm-none">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>



      <?php require "../layouts/footer.php"; ?>