<?php session_start(); include_once 'includes/dbh.inc.php';?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

    <header>
      <nav>
        <div class="main-wrapper">
          <ul>
            <li><a href="index.php">Home</a></li>
          </ul>
          <div class="nav-login">

            <?php
              if (isset($_SESSION['u_id'])) {
                echo '<form action="includes/logout.inc.php" method="post">
                      <button type="submit" name="submit">Logout</button>
                      </form>';
              } else {
                echo '<form action="includes/login.inc.php" method="post">
                  <input type="text" name="uid" placeholder="Username/e-mail">
                  <input type="password" name="pwd" placeholder="password">
                  <button type="submit" name="submit">Login</button>
                  </form>
                  <a href="signup.php">Sign up</a>';
              }
            ?>


          </div>

        </div>
      </nav>
    </header>
