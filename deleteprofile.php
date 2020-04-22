<?php
session_start();
include_once 'includes/dbh.inc.php';
$sessionid = $_SESSION['u_id'];

$filename = "uploads/profile".$sessionid."*";
$fileinfo = glob($filename);
$fileactualext = explode(".", $fileinfo[0])[1];

$file = "uploads/profile".$sessionid.".".$fileactualext;

if (!unlink($file)) {
  echo "File was not deleted!";
} else {
  echo "File was deleted!";
}

$sql = "UPDATE profileimg SET status=0 Where userid='$sessionid';";
mysqli_query($conn, $sql);

header("Location: index.php?delete=success");
