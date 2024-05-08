<?php require "../layouts/header.php"; ?>
<?php require "../../config/conf.php"; ?>

<?php
    if(!isset($_SESSION['email'])){
        header("location: ".ADMINURL."/admins/login-admins.php");
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        // Delete comments associated with the topic
        $deleteComments = $conn->prepare("DELETE FROM replies WHERE topic_id = :topic_id");
        $deleteComments->bindParam(':topic_id', $id);
        $deleteComments->execute();

        // Delete the topic
        $deleteTopic = $conn->prepare("DELETE FROM topics WHERE id = :id");
        $deleteTopic->bindParam(':id', $id);
        $deleteTopic->execute();

        header("location: show-topics.php");
    }
?>
