<?php

if(isset($_POST["register"])){
  header('Location:register.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="login.css">
  <title>LOG IN</title>
</head>

<body>

  <header>
    <h2 id="site-name">ALBUM SHOPPING SITE </h2>
    <h3 id="small-talk"><q><i>You can find all albums here...</i></q></h3>
  </header>

  <form method="post">

    User Type:
    <br>
    <select name="type">
        <option value="-1">select user type</option>
        <option value="Admin">Admin</option>
        <option value="User">User</option>
    </select>
    <br>
    Username:
    <br>
    <input type="text" name="username" >
    <br>
    Password:
    <br>
    <input type="password" name="pwd">
    <br>
    <input type="submit" name="submit" value="LOGIN" class="button">

    <form name="formRegister" action="" method="post">
      <input type="submit" name="register" value="REGISTER" class="register-btn">
    </form>
  </form>

</body>
</html>

<?php
//------CONNECTION  ----------
$server="localhost";
$user="root";
$password ="10471391.gh";
$database ="users";

$connect = mysqli_connect($server,$user,$password,$database);

if(!$connect){
  die("fail".mysqli_connect_error());
}

//---------------------------------
if(isset($_POST['submit'])){

  session_start();
  $message="";
  if(count($_POST)>0) {
      $result = mysqli_query($connect,"SELECT * FROM userattributes WHERE name='" . $_POST["username"] . "' and type='".$_POST["type"]."' and password = '". $_POST["pwd"]."'");
      $row  = mysqli_fetch_array($result);
      if(is_array($row)) {
        $_SESSION["id"] = $row['id'];
        $_SESSION["name"] = $row['name'];
        $_SESSION["password"] = $row['password'];
        if($row['type']=='Admin'){
          header("Location:admin-panel.php");
        }
        else{
          header("Location:albums.php");
        }
      } else {
        echo "<script>alert('Invalid Username or Password!!!')</script>";
      }
  }

}

  
?>