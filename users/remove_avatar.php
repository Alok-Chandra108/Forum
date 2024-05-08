<?php
require "../config/conf.php";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    // Get the ID from the form
    $id = $_POST["id"];

    // Fetch the user from the database
    $select = $conn->prepare("SELECT * FROM users WHERE id=:id");
    $select->execute([":id" => $id]);
    $user = $select->fetch(PDO::FETCH_OBJ);

    // Check if the user exists
    if ($user) {
        // Update the user's avatar to NULL (remove avatar)
        $update = $conn->prepare("UPDATE users SET avatar = NULL WHERE id=:id");
        $update->execute([":id" => $id]);

        // Set a default avatar image path
        $default_avatar = "gravatar.jpg";

        // Update the user_image in the topics table to the default avatar
        $update_topics = $conn->prepare("UPDATE topics SET user_image = :default_avatar WHERE user_name=:username");
        $update_topics->execute([":default_avatar" => $default_avatar, ":username" => $user->username]);

        // Update the user_image in the replies table to the default avatar
        $update_replies = $conn->prepare("UPDATE replies SET user_image = :default_avatar WHERE user_name=:username");
        $update_replies->execute([":default_avatar" => $default_avatar, ":username" => $user->username]);

        // Redirect back to the profile edit page
        header("Location: edit_users.php?id=$id");
        exit();
    } else {
        // User not found, redirect to an error page or handle accordingly
        header("Location: error.php");
        exit();
    }
} else {
    // If the form was not submitted, redirect to an error page or handle accordingly
    header("Location: error.php");
    exit();
}
?>
