<?php require "../layouts/header.php"; ?>
<?php require "../../config/conf.php"; ?>

<?php 
    if(!isset($_SESSION['email'])){
        header("location: ".ADMINURL."/admins/login-admins.php");
    }

    $topics = $conn->query("SELECT * FROM topics");
    $topics->execute();
    $Alltopics = $topics->fetchAll(PDO::FETCH_OBJ);
?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Topics</h5>
            
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">User</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($Alltopics as $topic) : ?>
                        <tr>
                            <th scope="row"><?php echo $topic->id; ?></th>
                            <td><?php echo $topic->title; ?></td>
                            <td><?php echo $topic->category; ?></td>
                            <td><?php echo $topic->user_name; ?></td>
                            <td>
                                <a href="delete-topic.php?id=<?php echo $topic->id; ?>" class="btn btn-danger text-center d-none d-sm-inline">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                                <a href="delete-topic.php?id=<?php echo $topic->id; ?>" class="btn btn-sm btn-danger text-center d-inline d-sm-none">
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
