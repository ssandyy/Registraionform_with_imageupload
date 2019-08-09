<?php

session_start();
$_SESSION['message'] = '';
$conn = mysqli_connect('localhost', 'root', '', 'fileupload');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($_POST['password'] == $_POST['confirmpassword']) {

    $username = $conn->real_escape_string($_POST['username']);
    $password = md5($_POST['password']); // password_hash($password, PASSWORD_BCRYPT)
    $image = $conn->real_escape_string('image/'.$_FILES['file']['name']);
    $country = $conn->real_escape_string($_POST['country']);
  }
  else {
    echo "password not mactch...";
  }
}

?>
