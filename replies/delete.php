<?php require "../includes/header.php";		?>
<?php require "../config/conf.php";			?>


<?php 
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $select = $conn->query("SELECT * FROM replies WHERE id='$id'");
    $select->execute();
    $reply=$select->fetch(PDO::FETCH_OBJ);

    if($reply->user_id !== $_SESSION['user_id']){
        header("loctaion: ".APPURL."");
    }
    else{
        $delete = $conn->query("DELETE FROM replies WHERE id ='$id'");
    $delete->execute();

    header("location: ".APPURL."");
    }


    
}
?>