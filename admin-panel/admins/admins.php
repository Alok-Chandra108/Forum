<?php require "../layouts/header.php"; ?>
<?php require "../../config/conf.php"; ?>
    <?php 
    if(!isset($_SESSION['email'])){
			header("location: ".ADMINURL."/admins/login-admins.php");
		}

  $admins = $conn->query("SELECT * FROM admins");
  $admins->EXECUTE();
  $allAdmins = $admins->fetchAll(PDO::FETCH_OBJ);
  

    ?>
          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Admins</h5>
             <a  href="create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">E-mail</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($allAdmins as $admin) : ?>
                  <tr>
                    <th scope="row"><?php echo $admin->id; ?></th>
                    <td><?php echo $admin->adminname; ?></td>
                    <td><?php echo $admin->email; ?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



      <?php require "../layouts/footer.php"; ?>