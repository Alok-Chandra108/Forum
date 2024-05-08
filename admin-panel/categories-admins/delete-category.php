<?php require "../layouts/header.php"; ?>
<?php require "../../config/conf.php"; ?>

    <?php

        if(!isset($_SESSION['email'])){
			header("location: ".ADMINURL."/admins/login-admins.php");
		}

        if(isset($_GET['id'])){
            $id= $_GET['id'];

            $delete = $conn->query("DELETE FROM categories WHERE id='$id'");

            $delete->execute();

            header("location: show-categories.php");

        }

    ?>