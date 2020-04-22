<?php
    // We check if the user has clicked the signup button
    if (isset($_POST['submit'])) {
        // Then we include the database connection
        include_once 'dbh.inc.php';
        // And we get the data from the signup form
        $first = mysqli_real_escape_string($conn, $_POST['first']);
        $last = mysqli_real_escape_string($conn, $_POST['last']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $uid = mysqli_real_escape_string($conn, $_POST['uid']);
        $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

        // Error handlers
        // Check if inputs are empty
        if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
            header("Location: ../signup.php?signup=empty");
            exit();
        } else {
            // Check if input characters are valid
            if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
                header("Location: ../signup.php?signup=invalidchar");
                exit();
            } else {
                // Check if email is valid
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    header("Location: ../signup.php?signup=invalidemail&first=$first&last=$last&uid=$uid");
                    exit();
                }
                else {
                    $sql = "SELECT * FROM users WHERE user_uid='$uid'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if ($resultCheck > 0) {
                        header("Location: ../signup.php?signup=usertaken&first=$first&last=$last&uid=$uid&email=$email");
                    } else {
                        // Hashing the password
                        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                        // Insert the user into the database
                        $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES (?, ?, ?, ?, ?);";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)){
                            echo "SQL error";
                        } else {
                            mysqli_stmt_bind_param($stmt, "sssss", $first, $last, $email, $uid, $hashedPwd);
                            mysqli_stmt_execute($stmt);
                        }


                        $sql = "SELECT * FROM users WHERE user_uid='$uid' AND user_first='$first'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $userid = $row['user_id'];
                                $sql = "INSERT INTO profileimg (userid, status) VALUES ('$userid', 0);";
                                mysqli_query($conn, $sql);
                            }
                        } else {
                            echo "There are no users yet!";
                        }

                        header("Location: ../signup.php?signup=success");
                        exit();
                    }
                }
            }
        }
    } else {
        header("Location: ../signup.php");
        exit();
    }
