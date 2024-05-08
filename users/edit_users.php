<?php require "../includes/header.php"; ?>
<?php require "../config/conf.php"; ?>

<?php 
// Redirect user if not logged in
if(!isset($_SESSION['username'])){
    header("location: ".APPURL."");
}

// Check if user has permission to edit profile
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $select = $conn->query("SELECT * FROM users WHERE id='$id'");
    $select->execute();
    $user = $select->fetch(PDO::FETCH_OBJ);

    if($user->id !== $_SESSION['user_id']){
        header("location: ".APPURL."");
    }
}

// Handle form submission
if(isset($_POST['submit'])){
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $about = isset($_POST['about']) ? $_POST['about'] : '';

    // Update email and about
    $update = $conn->prepare("UPDATE users SET email = :email, about = :about WHERE id='$id'");
    $update->execute([
        ":email" => $email,
        ":about" => $about,
    ]);

    // Check if a new avatar was uploaded
    if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK){
        $avatar_name = $_FILES['avatar']['name'];
        $avatar_tmp = $_FILES['avatar']['tmp_name'];
        $upload_dir = "../img/";
        $avatar_path = $upload_dir . $avatar_name;

        // Move uploaded file to desired location
        if(move_uploaded_file($avatar_tmp, $avatar_path)){
            // Update avatar in the database
            $update_avatar = $conn->prepare("UPDATE users SET avatar = :avatar WHERE id='$id'");
            $update_avatar->execute([":avatar" => $avatar_path]);

            // Update user_image in topics table
            $update_topics = $conn->prepare("UPDATE topics SET user_image = :user_image WHERE user_name=:user_name");
            $update_topics->execute([":user_image" => $avatar_path, ":user_name" => $user->username]);

            // Update user_image in replies table
            $update_replies = $conn->prepare("UPDATE replies SET user_image = :user_image WHERE user_name=:user_name");
            $update_replies->execute([":user_image" => $avatar_path, ":user_name" => $user->username]);
        } else {
            echo "<script>alert('Failed to upload avatar.');</script>";
        }
    }

    // Update password (if provided)
    if(!empty($_POST['password'])){
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $update_password = $conn->prepare("UPDATE users SET password = :password WHERE id='$id'");
        $update_password->execute([":password" => $password]);
    }

    header("location: ".APPURL."");
}
?>   
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left">Update Profile</h1>
                    <div class="clearfix"></div>
                    <hr>
                    <form role="form" enctype="multipart/form-data" action="edit_users.php?id=<?php echo $id; ?>" method="POST">
                    <div class="form-group">
    <label>Upload Avatar</label>
    <input type="file" name="avatar" id="avatarInput" onchange="previewAvatar(event)">
    <br>
    <img id="avatarPreview" src="../img/<?php echo $user->avatar; ?>" alt="Avatar Preview" style="max-width: 150px; max-height: 150px; border-radius: 50%;">
</div>

<script>
function previewAvatar(event) {
    var input = event.target;
    var preview = document.getElementById('avatarPreview');
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '../img/<?php echo $user->avatar; ?>';
    }
}
</script>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" value="<?php echo $user->email; ?>" class="form-control" name="email" placeholder="Enter Your Email">
                        </div>
                        <div class="form-group">
                            <label>About Me</label>
                            <textarea id="about" rows="3" cols="10" class="form-control" name="about"><?php echo $user->about; ?></textarea>
                            <script>CKEDITOR.replace('about');</script>
                        </div>
                        
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter New Password">
                        </div>
                        <button type="submit" name="submit" class="color btn btn-default">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <?php require "../includes/footer.php"; ?>
