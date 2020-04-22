<?php include_once 'header.php'; ?>

<section class="main-container">
  <div class="main-wrapper">
    <h2>Duduji login system</h2>
    <?php
      if (isset($_GET['signup'])) {
        if ($_GET['signup'] == "success") {
          echo "<p class='success'> You have been signed up! Please login.</p>";
        }
      }
      if (isset($_SESSION['u_id'])) {
        echo '<p class="success"> You are logged in! Welcome to Duji\'s website! <br> You can upload/modify your profile image below.</p>';
          $userid = $_SESSION['u_id'];
          $sql = "SELECT * FROM users WHERE user_id='$userid';";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $uid = $row['user_id'];
              $sqlImg = "SELECT * FROM profileimg WHERE userid='$uid';";
              $resultImg = mysqli_query($conn, $sqlImg);

              while ($rowImg = mysqli_fetch_assoc($resultImg)) {
                echo "<div>";
                  if ($rowImg['status'] == 1) {
                    $filename = "uploads/profile".$userid."*";
                    $fileinfo = glob($filename);
                    $fileactualext = explode(".", $fileinfo[0])[1];
                    echo "<img class='profile-img' src='uploads/profile".$uid.".".$fileactualext."?".mt_rand()."'>";
                  } else {
                    echo "<img class='profile-img' src='uploads/profiledefault.jpg'>";
                  }
                  echo "<p>".$row['user_first']." ".$row['user_last']."</p>";
                echo "</div>";
              }
            }
          } else {
            echo "There are no users yet!";
          }


        echo '<form class="upload-form" action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file">
            <button type="submit" name="submit">UPLOAD</button>
            </form>';
        echo '<form class="upload-form" action="deleteprofile.php" method="post">
            <button type="submit" name="submit">Delete Profile Image</button>
            </form>';
      }
      elseif (isset($_GET['login'])) {
        $login = $_GET['login'];
        if ($login == "empty") {
          echo '<p class="error"> Please enter your username/email and password!</p>';
        }
        elseif ($login == "error") {
          echo '<p class="error"> User does not exist or wrong password! </p>';
        }
      }
    ?>
  </div>
</section>


<?php include_once 'footer.php' ?>
