<?php require "../includes/header.php"; ?>
<?php require "../config/conf.php"; ?>

<?php
// Redirect user if already logged in
if (isset($_SESSION['email'])) {
    header("location: " . APPURL . "");
}

if (isset($_POST['submit'])) {
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password'])) {
        echo "<script>alert('Please fill all the fields');</script>";
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $about = isset($_POST['about']) ? $_POST['about'] : '';

        // File upload handling
        $avatar_name = $_FILES['avatar']['name'];
        $avatar_tmp = $_FILES['avatar']['tmp_name'];
        $upload_dir = "../img/";
        $avatar_path = $upload_dir . $avatar_name;

        // Check if file was uploaded without errors
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            // Move uploaded file to desired location
            if (move_uploaded_file($avatar_tmp, $avatar_path)) {
                // File uploaded successfully

                // Check if username already exists (case-sensitive)
                $select = $conn->prepare("SELECT * FROM users WHERE BINARY username = :username");
                $select->execute([":username" => $username]);
                if ($select->rowCount() > 0) {
                    echo "<script>alert('Username already exists. Please choose a different username.');</script>";
                } else {
                    // Insert user data into the database
                    $insert = $conn->prepare("INSERT INTO users (name, email, username, password, about, avatar) VALUES (:name, :email, :username, :password, :about, :avatar)");
                    $insert->execute([
                        ":name" => $name,
                        ":email" => $email,
                        ":username" => $username,
                        ":password" => $password,
                        ":about" => $about,
                        ":avatar" => $avatar_path, // Store avatar path in the database
                    ]);
                    header("location: login.php");
                }
            } else {
                // Failed to move file
                echo "<script>alert('Failed to upload avatar.');</script>";
            }
        } else {
            // No file uploaded or upload error occurred
            echo "<script>alert('Please select an image file to upload.');</script>";
        }
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left">Register</h1>
                    <h4 class="pull-right">A Simple Forum</h4>
                    <div class="clearfix"></div>
                    <hr>
                    <form role="form" enctype="multipart/form-data" method="post" action="register.php">
                        <div class="form-group">
                            <label>Name*</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Your Name">
                        </div>
                        <div class="form-group">
                            <label>Email Address*</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter Your Email Address">
                        </div>
                        <div class="form-group">
                            <label>Choose Username*</label>
                            <input type="text" class="form-control" name="username" placeholder="Create A Username">
                        </div>
                        <div class="form-group">
                            <label>Password*</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter A Password">
                        </div>
                        <div class="form-group">
                            <label>Upload Avatar</label>
                            <input type="file" name="avatar">
                        </div>
                        <div class="form-group">
                            <label>About Me</label>
                            <textarea id="about" rows="6" cols="80" class="form-control" name="about" placeholder="Tell us about yourself (Optional)"></textarea>
                        </div>
                        <input name="submit" type="submit" class="color btn btn-default" value="Register" />
                    </form>
                </div>
            </div>
        </div>
        <?php require "../includes/footer.php"; ?>
