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

    if (preg_match("!image!", $_FILES['file']['type'])){

      if (copy($_FILES['file']['tmp_name'], $image)){
        $_SESSION['username']=$username;
        $_SESSION['file'] = $image;

        $sql = "insert into imageupload (username, password, file, country) values('$username', '$password', '$image', '$country')";

        if($conn->query($sql)===true) {
          $_SESSION['message']='Registration sucessfull!';
          header("localhost: welcome.php");
        }

      }
    }

  }
  else {
    echo "password not mactch...";
  }
}

?>




<html>
 <head>
 	<meta>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 </head>
 <body>
 	<form action="loginpage1.php" method="POST" enctype="multipart/form-data">
 		<div class="alert alert-error">
      <?=
      $_SESSION['message'];
      ?>
    </div>
 			<input type="text" name="username" placeholder="username"/><br>
 			<input type="password" name="password" placeholder="password"/><br>
      <input type="password" name="confirmpassword" placeholder="confirmpassword"/>
 			<div><label>Select your profile pic :</lable><input type="file" name="file" /></div><br>
      <select name="country">
        <option>india</option>
        <option>Pakistan</option>
        <option>Srilanka</option>
        <option>Nepal</option>
        <option>Bangladesh</option>
      </select><br>
 			<input type="submit" name="submit" />
 		</div>
 	</form>
 </body>
</html>
