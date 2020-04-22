<?php include_once 'header.php' ?>

<section class="main-container">
  <div class="main-wrapper">
    <h2>Duduji signup form</h2>
    <form class="signup-form" action="includes/signup.inc.php" method="post">
      <?php
        if (isset($_GET['first'])) {
          $first = $_GET['first'];
          echo '<input type="text" name="first" placeholder="First name" value="'.$first.'">';
        }
        else {
          echo '<input type="text" name="first" placeholder="First name">';
        }

        if (isset($_GET['last'])) {
          $last = $_GET['last'];
          echo '<input type="text" name="last" placeholder="Last name" value="'.$last.'">';
        }
        else {
          echo '<input type="text" name="last" placeholder="Last name">';
        }

        if (isset($_GET['email'])) {
          $email = $_GET['email'];
          echo '<input type="text" name="email" placeholder="E-mail" value="'.$email.'">';
        }
        else {
          echo '<input type="text" name="email" placeholder="E-mail">';
        }

        if (isset($_GET['uid'])) {
          $uid = $_GET['uid'];
          echo '<input type="text" name="uid" placeholder="User name" value="'.$uid.'">';
        }
        else {
          echo '<input type="text" name="uid" placeholder="User name">';
        }
      ?>

      <input type="password" name="pwd" placeholder="Password">

      <button type="submit" name="submit">Sign up</button>
    </form>
    <?php
      if (!isset($_GET['signup'])) {
        exit();
      } else {
        $signupCheck = $_GET['signup'];

        if ($signupCheck == "empty") {
          echo "<p class='error'> You did not fill in all fields!</p>";
          exit();
        }
        elseif ($signupCheck == "invalidchar") {
          echo "<p class='error'> You used invalid characters!</p>";
          exit();
        }
        elseif ($signupCheck == "invalidemail") {
          echo "<p class='error'> You used an invalid e-mail!</p>";
          exit();
        }
        elseif ($signupCheck == "usertaken") {
          echo "<p class='error'> User ID ".$_GET['uid']." is taken. Please try another one!</p>";
          exit();
        }
        elseif ($signupCheck == "success") {
          header("Location: index.php?signup=success");
          exit();
        }
      }
    ?>
  </div>
</section>


<?php include_once 'footer.php' ?>
