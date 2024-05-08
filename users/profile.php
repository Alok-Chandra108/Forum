<?php require "../includes/header.php";		?>
<?php require "../config/conf.php";			?>

<?php

if(!isset($_SESSION['username'])){
			header("location: ".APPURL."");
		}
		
        //grabing the data
        if(isset($_GET['name'])){

            $name = $_GET['name'];

            $select = $conn->query("SELECT * FROM users WHERE username='$name'");
            $select->execute();
            $users=$select->fetch(PDO::FETCH_OBJ);

            //counting number of topics
            $num_topics = $conn->query("SELECT COUNT(*) as num_topics FROM topics WHERE user_name='$name'");
            $num_topics->execute();
            $allnum_topics=$num_topics->fetch(PDO::FETCH_OBJ);

            //counting number of replies
            $num_replies = $conn->query("SELECT COUNT(*) as num_replies FROM replies WHERE user_name='$name'");
            $num_replies->execute();
            $allnum_replies=$num_replies->fetch(PDO::FETCH_OBJ);

        }

?>

    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="main-col">
            <div class="block">
              <h1 class="pull-left"><?php echo $users->name; ?></h1>
              <h4 class="pull-right">Your Profile</h4>
              <div class="clearfix"></div>
              <hr>
              <ul id="topics">
                              <li id="main-topic" class="topic topic">
                                  <div class="row">
                                      <div class="col-md-2">
                                          <div class="user-info">
                                              <img class="avatar pull-left rounded-circle" style="border-radius: 50%;" src="../img/<?php echo $users->avatar; ?>" />
                                              <ul>
                                                  <li><strong><?php echo $users->username; ?></strong></li>
                                                  <li><a href="profile.php?name=<?php echo $users->username; ?>">Profile</a>
                                              </ul>
                                          </div>
                                      </div>
                                      <div class="col-md-10">
                                          <div class="topic-content pull-right">
                                              <p>
                                                  <?php echo $users->about; ?>
                                              </p>
                                          </div>

                                              <a class="btn btn-success" href="" role="button">Number of Topics: <?php echo $allnum_topics->num_topics; ?></a>
                                              <a class="btn btn-primary" href="" role="button">Number of Replies: <?php echo $allnum_replies->num_replies; ?></a>
                                          
                                      </div>
                                      
                                  </div>
                              </li>
                              
                              
              </ul>
          
            </div>
          </div>
        </div>
        <?php require "../includes/footer.php";		?>