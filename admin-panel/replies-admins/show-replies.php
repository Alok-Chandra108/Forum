<?php require "../layouts/header.php"; ?>
<?php require "../../config/conf.php"; ?>

<?php 
    if(!isset($_SESSION['email'])){
        header("location: ".ADMINURL."/admins/login-admins.php");
    }

    $replies = $conn->query("SELECT * FROM replies");
    $replies->execute();
    $Allreplies = $replies->fetchAll(PDO::FETCH_OBJ);
?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Replies</h5>
            
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Reply</th>          
                            <th scope="col">Username</th>
                            <th scope="col">Go to topic</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($Allreplies as $reply) :  ?>
                        <tr>
                            <th scope="row"><?php echo $reply->id; ?></th>
                            <td><?php echo $reply->reply; ?></td>
                            <td><?php echo $reply->user_name; ?></td>
                            <td>
                                <a href="http://localhost/forum/topics/topic.php?id=<?php echo $reply->topic_id; ?>" class="btn btn-success text-center d-none d-sm-inline">
                                    <i class="fa fa-arrow-right"></i> Go to topic
                                </a>
                                <a href="http://localhost/forum/topics/topic.php?id=<?php echo $reply->topic_id; ?>" class="btn btn-success text-center d-inline d-sm-none">
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                            </td>
                            <td>
                                <a href="delete-replies.php?id=<?php echo $reply->id; ?>" class="btn btn-danger text-center d-none d-sm-inline">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                                <a href="delete-replies.php?id=<?php echo $reply->id; ?>" class="btn btn-danger text-center d-inline d-sm-none">
                                    <i class="fa fa-trash"></i>
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